<?php

namespace Uzair3\Attendance\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Uzair3\Attendance\Models\Attendance;
use Uzair3\Attendance\Models\Leave;
use Uzair3\Attendance\Models\AttendanceCorrection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class AttendanceController extends Controller
{
    // public function dashboard(){
        
    //     return view('attendance::user.dashboard.index');
    // }

    public function mark_attendance(){
        
        $on_leave = Leave::where('user_id', auth()->id())
            ->where('status', 'Approved') 
            ->whereDate('from', '<=', now()->toDateString())
            ->whereDate('to', '>=', now()->toDateString())
            ->exists();

        $todays_attendance = Attendance::where('user_id',auth()->id())->whereDate('check_in', now()->toDateString())->get();
        return view('attendance::user.dashboard.mark_attendance',compact('todays_attendance','on_leave'));
    }
    

    public function store(Request $request)
    {
        $userId = auth()->id();
        $request->validate([
            'employee_image' => 'image|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('employee_image')) {
            $imagePath = $request->file('employee_image')->store('employee_images', 'public');
        }
        $officeStartTime = config('attendance.office_start_time');
        $currentTime = now()->toTimeString();
        $in_status = null;
        if ($officeStartTime < $currentTime)
            $in_status = 'Late';
        else
            $in_status = 'On Time';
        
        $attendance = Attendance::create([
            'user_id' => $userId,
            // 'date' => now()->toDateString(),
            'employee_img' => $imagePath,
            'check_in' => now(),
            'in_status' => $in_status
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Attendance recorded successfully!',
            'attendance' => $attendance,
        ]);    
    }

    public function checkIn(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'attendance_image' => 'required|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        // Store Image
        $imagePath = $request->file('attendance_image')->store('employee_images', 'public');

        $attendance = Attendance::where('user_id', $user->id)
            ->whereDate('check_in', now()->toDateString())
            ->first();
        $officeStartTime = config('attendance.office_start_time');
        $currentTime = now()->toTimeString();
        $in_status = null;
        if ($officeStartTime < $currentTime)
            $in_status = 'Late';
        else
            $in_status = 'On Time';

        if (!$attendance) {
            $attendance = Attendance::create([
                'user_id' => $user->id,
                'check_in' => now(),
                'in_status' => $in_status,
                'employee_img' => $imagePath
            ]);
            return response()->json(['message' => 'Check-in successful']);
        }
        else{
            return response()->json(['error' => 'Attendance has already been marked']);
        }

    }

    public function checkOut(Request $request)
    {
        $user = auth()->user();

        // $request->validate([
        //     'attendance_image' => 'required|image|mimes:jpg,png,jpeg|max:2048'
        // ]);

        $attendance = Attendance::where('user_id', $user->id)
            ->whereDate('check_in', now())
            ->first();

        
        if (!$attendance) {
            return response()->json(['error' => 'Check-in required'], 400);
        }

        // Store Image
        // $imagePath = $request->file('attendance_image')->store('check_out_images', 'public');

        $officeEndTime = config('attendance.office_end_time');
        $currentTime = now()->toTimeString();
        $out_status = null;
        if ($officeEndTime < $currentTime)
            $out_status = 'Overtime';
        else if($officeEndTime == $currentTime)
            $out_status = 'On Time';
        else if($officeEndTime > $currentTime)
            $out_status = 'Early';

        $attendance->update([
            'check_out' => now(),
            'out_status' => $out_status,
            // 'check_out_image' => $imagePath
        ]);

        return response()->json(['message' => 'Check-out successful']);
    }


    public function attendance_correction_request(){
        $userId = auth()->id();

        $attendance_dates = Attendance::select(DB::raw('DATE(check_in) as date'))
            ->where('user_id',$userId)
            ->distinct()
            ->orderBy('date', 'asc')
            ->pluck('date');


        return view('attendance::attendance/attendance_correction_request', compact('attendance_dates'));
    }
    public function update_attendance(Request $request, $attendanceId){
        
        $request->validate([
            'check_in' => 'required|date_format:Y-m-d H:i:s',
            'in_status' => 'required|string|max:255',
            'check_out' => 'required|date_format:Y-m-d H:i:s|after:check_in',
            'out_status' => 'required|string|max:255',
        ]);

        $attendance = Attendance::find($attendanceId);
        if (!$attendance) {
            return response()->json(['success' => false, 'message' => 'Attendance not found']);
        }
        $attendance->check_in = $request->check_in;
        $attendance->in_status = $request->in_status;
        $attendance->check_out = $request->check_out;
        $attendance->out_status = $request->out_status;
        $attendance->save();
        
        return response()->json(['success' => true, 'message' => 'Attendance Updated Successfully', 'updatedRecord' => $attendance]);
    }
    public function delete_attendance($attendance_id){
        $attendance = Attendance::find($attendance_id);

        if (!$attendance) {
            return response()->json(['success' => false, 'message' => 'User not found.']);
        }

        $attendance->delete();
        return response()->json(['success' => true, 'message' => 'Attendance record deleted successfully.']);
    }

    public function fetchAttendanceData(Request $request)
    {
        $validatedData = $request->validate([
            'date' => ['required', 'date', function ($attribute, $value, $fail) {
                $userId = Auth::id();
                $exists = Attendance::where('user_id', $userId)
                    ->whereDate('check_in', $value)
                    ->exists();

                if (!$exists) {
                    $fail('The selected date is invalid or not found for the logged-in user.');
                }
            }],
        ]);

        $attendance_correction_exists = AttendanceCorrection::with('attendance')
            ->whereHas('attendance', function ($query) {
                    $query->where('user_id', Auth::id());
                })
            ->whereDate('requested_check_in', $validatedData['date'])
            ->where('status','Pending')
            ->first();
        if($attendance_correction_exists){
            return response()->json([
                'correction_existence_msg' => 'Correction is pending for this date',
            ]);
        }

        $latest_correction_record_ids = DB::table('attendance_corrections')->where('status','Approved')->select(DB::raw('max(id) as max_id'))->groupby('attendance_id');

        $latest_correction_records = DB::table('attendance_corrections as ac')
            ->JoinSub($latest_correction_record_ids, 'latest_correction_ids','ac.id','latest_correction_ids.max_id')->select('ac.*');

        $attendance = Attendance::query()
            ->leftJoinSub(
                $latest_correction_records,
                'corrections',
                'corrections.attendance_id',
                '=',
                'attendances.id'
            )
            ->select([
                'attendances.id',
                'attendances.user_id',
                DB::raw('COALESCE(corrections.requested_check_in, attendances.check_in) AS effective_check_in'),
                DB::raw('COALESCE(corrections.requested_check_out, attendances.check_out) AS effective_check_out'),
            ])
            ->where('user_id', Auth::id())
            ->whereDate(DB::raw('COALESCE(corrections.requested_check_in, attendances.check_in)'), $validatedData['date'])
            ->get();
            
        // dd($attendance->toSql(), $attendance->getBindings());
        
        return response()->json([
            'attendance_id' => $attendance[0]['id'],
            'check_in' => $attendance[0]['effective_check_in'],
            'check_out' => $attendance[0]['effective_check_out'],
        ]);
    }
}

<?php

namespace Uzair3\Attendance\Controllers;

use Illuminate\Http\Request;
use Uzair3\Attendance\Models\AttendanceCorrection;
use App\Models\Attendance;


class AttendanceCorrectionController extends Controller
{
    public function post_attendance_correction_request(Request $request)
    {

        $officeStartTime = config('attendance.office_start_time');
        $officeEndTime = config('attendance.office_end_time');

        $His_format_check_in_time = $request->requested_check_in.':00';
        $His_format_check_out_time = $request->requested_check_out.':00';
        $in_status = null;
        $out_status = null;
        if ($officeStartTime < $His_format_check_in_time)
            $in_status = 'Late';
        else
            $in_status = 'On Time';

        if ($officeEndTime < $His_format_check_out_time)
            $out_status = 'Overtime';
        else if ($officeEndTime == $His_format_check_out_time)
            $out_status = 'On Time';
        else if ($officeEndTime > $His_format_check_out_time)
            $out_status = 'Early';

        $request->merge([
            'requested_check_in' => $request->attendance_date . ' ' . $request->requested_check_in .':00',
            'requested_check_out' => $request->attendance_date . ' ' . $request->requested_check_out .':00',
            'requested_in_status' => $in_status,
            'requested_out_status' => $out_status,
        ]);

        $validatedData = $request->validate([
            'attendance_id' => ['required', 'exists:attendances,id'],
            'reason' => ['required', 'string', 'max:255'],
            'requested_check_in' => ['required', 'date', 'before:requested_check_out'],
            'requested_check_out' => ['required', 'date', 'after:requested_check_in'],
        ]);

        // $same_attendance_correction_date = AttendanceCorrection::whereDate('requested_check_in', )
        
        AttendanceCorrection::create([
            'attendance_id' => $validatedData['attendance_id'],
            'reason' => $validatedData['reason'],
            'requested_check_in' => $validatedData['requested_check_in'],
            'requested_in_status' => $in_status,
            'requested_check_out' => $validatedData['requested_check_out'],
            'requested_out_status' => $out_status,
        ]);

        return response()->json(['message' => 'Correction request submitted successfully!']);
    }
    public function attendance_correction()
    {
        $attendance_corrections = AttendanceCorrection::with('attendance.user')->get();
        
        return view('attendance::attendance/attendance_correction',compact('attendance_corrections'));

    }

    public function approve($id){
        
        $attendance_correction = AttendanceCorrection::findOrFail($id);
        if (!$attendance_correction) {
            return response()->json(['success' => false, 'message' => 'Attendance Correction record not found']);
        }
        else if ($attendance_correction->status == 'Pending') {
            $attendance_correction->status = 'Approved';
            $attendance_correction->save();

            return response()->json(['success' => true, 'message' => 'Attendance correction approved Successfully','updatedStatus'=> $attendance_correction->status]);
        }
    }
    public function reject($id){
        
        $attendance_correction = AttendanceCorrection::findOrFail($id);
        if (!$attendance_correction) {
            return response()->json(['success' => false, 'message' => 'Attendance correction record not found']);
        }
        else if ($attendance_correction->status == 'Pending') {
            $attendance_correction->status = 'Rejected';
            $attendance_correction->save();

            return response()->json(['success' => true, 'message' => 'Attendance Correction Rejected Successfully','updatedStatus'=> $attendance_correction->status]);
        }
    }

}

<?php

namespace Uzair3\Attendance\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Uzair3\Attendance\Models\Attendance;
use Uzair3\Attendance\Models\Leave;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ReportController extends Controller
{
    public function attendance_report_view(){

        $users = User::withTrashed()->select('id', 'name')->get();
        return view('attendance::report/attendanceReport', compact('users'));
    }

    public function leave_report_view(){
        $users = User::withTrashed()->select('id', 'name')->get();
        return view('attendance::report/leaveReport', compact('users'));
    }

    public function attendance_report(Request $request){
        
        $validatedData = $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'user_id' => 'nullable|exists:users,id',
            'in_status' => ['nullable', Rule::in(\Uzair3\Attendance\Models\Attendance::getInStatusOptions())],
            'out_status' => ['nullable', Rule::in(\Uzair3\Attendance\Models\Attendance::getOutStatusOptions())],
        ]);
        $to_date = Carbon::parse($request->to_date)->endOfDay();

        $latest_correction_record_ids = DB::table('attendance_corrections')->where('status','Approved')->select(DB::raw('max(id) as max_id'))->groupby('attendance_id');


        $latest_correction_records = DB::table('attendance_corrections as ac')
            ->JoinSub($latest_correction_record_ids, 'latest_correction_ids','ac.id','latest_correction_ids.max_id')->select('ac.*');
 

        $data = Attendance::query()
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
                'attendances.in_status',
                'attendances.out_status',
                'attendances.check_in',
                'attendances.check_out',
                DB::raw('COALESCE(corrections.requested_check_in, attendances.check_in) AS effective_check_in'),
                DB::raw('COALESCE(corrections.requested_check_out, attendances.check_out) AS effective_check_out'),
                DB::raw('COALESCE(corrections.requested_in_status, attendances.in_status) AS effective_in_status'),
                DB::raw('COALESCE(corrections.requested_out_status, attendances.out_status) AS effective_out_status')
            ])
            
            ->whereBetween(DB::raw('COALESCE(corrections.requested_check_in, attendances.check_in)'), [$request->from_date, $to_date])
            ->when($request->filled('user_id'), function ($query) use ($request) {
                $query->where('attendances.user_id', $request->user_id);
            })
            ->when($request->filled('in_status'), function ($query) use ($request) {
                $query->where(DB::raw('COALESCE(corrections.requested_in_status, attendances.in_status)'), $request->in_status);
            })
            ->when($request->filled('out_status'), function ($query) use ($request) {
                $query->where(DB::raw('COALESCE(corrections.requested_out_status, attendances.out_status)'), $request->out_status);
            })
            ->get();
        
            // dd($data->toSql(), $data->getBindings());
    


        $view = view('attendance::partials.report_table', compact('data'))->render();

        return response()->json([
            'success' => true,
            'html' => $view,
        ]);
    }

    public function leave_report(Request $request){
        
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'user_id' => 'nullable|exists:users,id',
            'status' => ['nullable', Rule::in(\Uzair3\Attendance\Models\Leave::getStatusOptions())],
            
        ]);

        $data = Leave::with('user:id,name')
            ->where(function($query) use ($request) {
                $query->whereBetween('from', [$request->from_date, $request->to_date])
                      ->orWhereBetween('to', [$request->from_date, $request->to_date])
                      ->orWhere(function ($query) use ($request) {
                          $query->where('from', '<=', $request->from_date)
                                ->where('to', '>=', $request->to_date);
                      });
            })
            ->when($request->filled('user_id'), function ($query) use ($request) {
                $query->where('user_id', $request->user_id);
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->get();



        $view = view('attendance::partials.leave_report_table', compact('data'))->render();

        return response()->json([
            'success' => true,
            'html' => $view,
        ]);
    }
}

<?php

namespace Uzair3\Attendance\Controllers;

use Uzair3\Attendance\Controllers\Controller;

use Illuminate\Http\Request;
use Uzair3\Attendance\Models\Leave;
use Carbon\Carbon;



class LeavesController extends Controller
{
    public function leave_approval()
    {
        $applied_leaves = Leave::with('user')->get();
        return view('attendance::leaves/leave_approval',compact('applied_leaves'));
    }

    public function leave_apply(){
        return view('attendance::leaves/leave_apply');
    }

    public function store(Request $request)
    {
        $userId = auth()->id();
        $validatedData = $request->validate([
            'leaveType'  => 'required|string|max:255',
            'FromDate'   => 'required|date|before_or_equal:ToDate',
            'ToDate'     => 'required|date|after_or_equal:FromDate',
            'numOfDays'  => 'required|integer|min:1',
            'reason'     => 'required|string|max:1000',
        ]);

        $leave = Leave::create([
            'user_id' => $userId,
            'from' => $request->FromDate,
            'to' => $request->ToDate,
            'reason' => $request->reason,
            'status' => 'Pending',
            'type' => $request->leaveType
        ]);
        if($leave){
            return response()->json([
                'success' => true,
                'message' => 'Leave applied successfully!',
            ]);    
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Leave not applied!',
            ]);
        }
    }

    public function leave_balance(){
        $availed_medical_leaves = Leave::where('user_id', auth()->id())->where('status','Approved')->where('type','Medical Leave')->count();
        $remaining_medical_leaves = 25 - $availed_medical_leaves;

        $availed_casual_leaves = Leave::where('user_id', auth()->id())->where('status','Approved')->where('type','Casual Leave')->count();
        $remaining_casual_leaves = 25 - $availed_casual_leaves;
        $leave_data = [
            'availed_casual_leaves' => $availed_casual_leaves,
            'remaining_casual_leaves' => $remaining_casual_leaves,
            'availed_medical_leaves' => $availed_medical_leaves,
            'remaining_medical_leaves' => $remaining_medical_leaves
        ];
        return view('attendance::leaves/leave_balance', compact('leave_data'));
    }
    public function leave_list(){
        $userId = auth()->id();
        $leaves = Leave::where('user_id',$userId)->get();
        return view('attendance::leaves/leave_list', compact('leaves'));
    }
    public function approve($id){
        
        $leave = Leave::findOrFail($id);
        if (!$leave) {
            return response()->json(['success' => false, 'message' => 'Leave record not found']);
        }
        else if ($leave->status == 'Pending') {
            $leave->status = 'Approved';
            $leave->save();

            return response()->json(['success' => true, 'message' => 'Leave approved Successfully','updatedStatus'=> $leave->status]);
        }
    }
    public function reject($id){
        
        $leave = Leave::findOrFail($id);
        if (!$leave) {
            return response()->json(['success' => false, 'message' => 'Leave record not found']);
        }
        else if ($leave->status == 'Pending') {
            $leave->status = 'Rejected';
            $leave->save();

            return response()->json(['success' => true, 'message' => 'Leave Rejected Successfully','updatedStatus'=> $leave->status]);
        }
    }
}

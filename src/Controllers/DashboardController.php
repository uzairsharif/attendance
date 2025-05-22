<?php
namespace Uzair3\Attendance\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
// use Uzair3\Attendance\Models\User;
use Uzair3\Attendance\Models\Attendance;


class DashboardController extends Controller
{
    public function index(){
        $users = User::get();
        $totalUsers = $users->count();

        $officeStartTime = config('attendance.office_start_time');



        $onTimeToday = Attendance::whereDate('check_in', today()->toDateString())
            ->whereTime('check_in', '<=', $officeStartTime) 
            ->get();
        // dd('index of dashboard');


        $totalOnTimeToday = $onTimeToday->count();

        $lateToday = Attendance::whereDate('check_in', today()->toDateString())
            ->whereTime('check_in', '>', $officeStartTime) 
            ->get();

        $totalLateToday = $lateToday->count();

        $onTimePercentage = $totalUsers > 0 ? ($totalOnTimeToday / $totalUsers) * 100 : 0;
        $onTimePercentage = round($onTimePercentage, 2);

        $data = [
            'users' => $users,
            'totalUsers' => $totalUsers,
            'onTimeToday' => $onTimeToday,
            'totalOnTimeToday' => $totalOnTimeToday,
            'lateToday' => $lateToday,
            'totalLateToday' => $totalLateToday,
            'onTimePercentage' => $onTimePercentage
        ];
        
        return view('attendance::dashboard.index', compact('data'));
    }
}

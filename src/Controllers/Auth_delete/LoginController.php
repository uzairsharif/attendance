<?php

namespace Uzair3\Attendance\Controllers\Auth;

use App\Http\Controllers\Controller;
// use Uzair3\Attendance\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Uzair3\Attendance\AuthRedirectsTrait;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    use AuthRedirectsTrait;


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    // protected function authenticated(Request $request, $user)
    // {
    //     if ($user->role === 'admin') {
    //         return redirect()->route('admin.dashboard');
    //     } 
    //     else if ($user->role == 'user') {
    //         if ($user->status == 'active') {
    //             return redirect()->route('user.dashboard');
    //         } else {
    //             return redirect()->route('user.not_approved');
    //         }
    //     }

    // }
    protected function authenticated(Request $request, $user)
    {
        return $this->handleUserRedirection($user);
        // if ($user->status != 'active') {
        //     Auth::logout();
        //     return redirect()->route('user_not_approved');
        // }

        // if ($user->role == 'admin') {
        //     return redirect()->route('admin.dashboard');
        // } elseif ($user->role == 'user') {
        //     return redirect()->route('user.dashboard');
        // }
    }


}

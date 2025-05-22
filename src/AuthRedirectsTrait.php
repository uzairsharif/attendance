<?php

namespace Uzair3\Attendance;
use Illuminate\Support\Facades\Auth;

trait AuthRedirectsTrait
{
    public function handleUserRedirection($user)
    {
    
        if ($user->status != 'active') {
            Auth::logout();
            return redirect()->route('user_not_approved');
        }

        return match ($user->role) {

            'admin' => redirect()->route('admin.dashboard'),
            'user'  => redirect()->route('user.mark_attendance'),
            default => redirect('/'), // Default fallback route
        };
    }
}

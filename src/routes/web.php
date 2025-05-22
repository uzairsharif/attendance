<?php

// use Illuminate\Support\Facades\Route;


use Illuminate\Support\Facades\Route;
use Uzair3\Attendance\Controllers\DashboardController;
use Uzair3\Attendance\Controllers\EmployeesController;
use Uzair3\Attendance\Controllers\ReportController;
use Uzair3\Attendance\Controllers\DepartmentsController;
use Uzair3\Attendance\Controllers\ShiftsController;
use Uzair3\Attendance\Controllers\LocationsController;
use Uzair3\Attendance\Controllers\UsersController;
use Uzair3\Attendance\Controllers\LeavesController;
use Uzair3\Attendance\Controllers\AttendanceController;
use Uzair3\Attendance\Controllers\AttendanceCorrectionController;
use Uzair3\Attendance\Middleware\RoleMiddleware;

// Auth route controllers
// use Uzair3\Attendance\ontrollers\auth\LoginController;
// use Uzair3\Attendance\controllers\auth\RegisterController;
// use Uzair3\Attendance\controllers\auth\ForgotPasswordController;
// use Uzair3\Attendance\controllers\auth\ResetPasswordController;
// use Uzair3\Attendance\controllers\auth\ConfirmPasswordController;
// use Uzair3\Attendance\controllers\auth\VerificationController;

// below attendance route has to be removed.
// Route::get('attendance', [AttendanceController::class, 'index']);
    
    Route::get('/', function () {
        return view('welcome');
    });


    // Auth Routes
    // Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    // Route::post('login', [LoginController::class, 'login']);
    // Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    // Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    // Route::post('register', [RegisterController::class, 'register']);
    // Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    // Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    // Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    // Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
    // Route::get('password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
    // Route::post('password/confirm', [ConfirmPasswordController::class, 'confirm']);
    // Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
    // Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
    // Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
    // End Auth Routes
    // Auth::routes();
    Route::get('/not_approved', [UsersController::class, 'user_account_not_approved'])->name('user_not_approved');

Route::middleware(['web', 'auth', RoleMiddleware::class.':user'])->group(function () {

    // Route::get('/attendance', [AttendanceController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/mark_attendance', [AttendanceController::class, 'mark_attendance'])->name('user.mark_attendance');
    Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::post('/check_in', [AttendanceController::class, 'checkIn'])->name('attendance.checkin');
    Route::post('/check_out', [AttendanceController::class, 'checkOut'])->name('attendance.checkout');

    Route::get('/leave-apply', [LeavesController::class, 'leave_apply'])->name('leave-apply');
    Route::post('/leave-store', [LeavesController::class, 'store'])->name('leave.store');

    Route::get('/leave-balance', [LeavesController::class, 'leave_balance'])->name('leave-balance');
    Route::get('/leave-list', [LeavesController::class, 'leave_list'])->name('leave-list');

    Route::get('/attendance-correction-request', [AttendanceController::class, 'attendance_correction_request'])->name('attendance-correction-request');
    
    Route::post('/fetch-attendance-data', [AttendanceController::class, 'fetchAttendanceData']);
    Route::post('attendance_correction_request', [AttendanceCorrectionController::class, 'post_attendance_correction_request'])->name('attendance.correction');

    // Route::post('/profile-image-upload', [UsersController::class, 'uploadProfileImage'])->name('profile.image.upload');
});
    
// Route::middleware('auth', RoleMiddleware::class.':admin')->group(function () {
Route::middleware(['web', 'auth', RoleMiddleware::class.':admin'])->group(function () {

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/employees', [EmployeesController::class, 'index'])->name('employees');
    Route::get('/departments', [DepartmentsController::class, 'index'])->name('departments');
    Route::get('/shifts', [ShiftsController::class, 'index'])->name('shifts');
    Route::get('/locations', [LocationsController::class, 'index'])->name('locations');
    Route::get('/users', [UsersController::class, 'admin_side_users_list'])->name('users');

    Route::post('/delete-users/{userId}', [UsersController::class, 'delete_user'])->name('delete_user');
    Route::post('/update-user-status/{userId}', [UsersController::class, 'update_user_status'])->name('update_user_status');
    Route::put('/update-user/{userId}', [UsersController::class, 'update_user'])->name('update_user');

    // Route::put('/attendance/{id}/update', [UsersController::class, 'update_user'])->name('edit_attendance');
    // Route::post('/attendance/{id}/delete', [UsersController::class, 'delete_user'])->name('delete_attendance');

    Route::put('/attendance/{id}/update', [AttendanceController::class, 'update_attendance'])->name('attendance.update');
    Route::post('/attendance/{id}/delete', [AttendanceController::class, 'delete_attendance'])->name('delete_attendance');
    
    Route::get('/attendance-report', [ReportController::class, 'attendance_report_view'])->name('attendance-report');
    Route::get('/leave-report', [ReportController::class, 'leave_report_view'])->name('leave-report');

    Route::post('/attendance-report', [ReportController::class, 'attendance_report'])->name('attendance.report');
    Route::post('/leave-report', [ReportController::class, 'leave_report'])->name('leave.report');

    Route::get('/leave-approval', [LeavesController::class, 'leave_approval'])->name('leave-approval');

    Route::get('/attendance-correction', [AttendanceCorrectionController::class, 'attendance_correction'])->name('attendance-correction');
    Route::post('/attendance_correction/{id}/approve', [AttendanceCorrectionController::class, 'approve'])->name('attendance_correction.approve');
    Route::post('/attendance_correction/{id}/reject', [AttendanceCorrectionController::class, 'reject'])->name('attendance_correction.reject');

    Route::post('/leaves/{id}/approve', [LeavesController::class, 'approve'])->name('leaves.approve');
    Route::post('/leaves/{id}/reject', [LeavesController::class, 'reject'])->name('leaves.reject');

    // Route::post('/profile-image-upload', [UsersController::class, 'uploadProfileImage'])->name('profile.image.upload');
});

Route::middleware(['web','auth', RoleMiddleware::class.':admin,user'])->group(function () {
// Route::middleware(['auth', 'roleee:user,admin'])->group(function () {
    Route::post('/profile-image-upload', [UsersController::class, 'uploadProfileImage'])
        ->name('profile.image.upload');
});



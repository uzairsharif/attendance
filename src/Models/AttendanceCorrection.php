<?php
namespace Uzair3\Attendance\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceCorrection extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'attendance_id',
        'reason',
        'requested_check_in',
        'requested_check_out',
        'requested_in_status',
        'requested_out_status'
    ];
    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}

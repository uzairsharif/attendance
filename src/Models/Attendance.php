<?php

namespace Uzair3\Attendance\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'date',
        'check_in',
        'in_status',
        'check_out',
        'out_status',
        'employee_img',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public static function getInStatusOptions()
    {
        return ['On Time', 'Late'];
    }

    public static function getOutStatusOptions()
    {
        return ['On Time', 'Early', 'Overtime'];
    }
    public function corrections()
    {
        return $this->hasMany(AttendanceCorrection::class);
    }
}

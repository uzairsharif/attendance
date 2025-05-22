<?php

namespace Uzair3\Attendance\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\User;

class Leave extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function user(){

        return $this->belongsTo(User::class)->withTrashed();
    }
    public static function getStatusOptions()
    {
        return ['Pending','Approved', 'Rejected'];
    }
    public function getNumberOfDaysAttribute()
    {
        if ($this->from && $this->to) {
            return Carbon::parse($this->from)->diffInDays(Carbon::parse($this->to)) + 1;
        }
        return 0;
    }
}

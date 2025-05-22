<?php

namespace uzair3\Attendance\Console\Commands;

use Illuminate\Console\Command;
use Uzair3\Attendance\Models\Attendance;
use Carbon\Carbon;

class CheckOut extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkout:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check out at end of workday';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $defaultCheckoutTime = Carbon::today()->setHour(17)->setMinute(0)->setSecond(0);
        // dump($defaultCheckoutTime);
        $attendances = Attendance::whereDate('check_in', Carbon::today())
            ->whereNull('check_out')
            ->update(['check_out' => $defaultCheckoutTime, 'out_status' => 'On Time']);

        dump($attendances);
        $this->info($defaultCheckoutTime);
        $this->info("Auto Check-Out completed for {$attendances} employees.");

    }
}

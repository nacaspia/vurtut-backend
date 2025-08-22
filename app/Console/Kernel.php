<?php

namespace App\Console;

use App\Helpers\LogsHelper;
use App\Models\Log;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Lang;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $companies = \App\Models\Company::where('is_premium', true)
                ->whereNotNull('premium_expires_at')
                ->where('premium_expires_at', '<', now())
                ->get();
            $companies = $companies->toArray();
            if (!empty($companies[0])) {
                foreach ($companies as $company) {
                    $log = [
                        'obj_id' => $company['id'],
                        'subj_id' => $company['id'],
                        'subj_table' => 'companies',
                        'action' => 'is_premium_deactivated',
                        'type' => 'company',
                        'note' => $company['premium_expires_at'].' tarixindən keçdiyi üçün premium hesab deaktiv edildi.',
                        'ip_address' => !empty($_SERVER['REMOTE_ADDR'])? $_SERVER['REMOTE_ADDR']: null,
                        'created_at' => Carbon::now(),
                    ];
                    Log::create($log);
                    \App\Models\Company::where('id', $company['id'])->update(['is_premium' => false, 'premium_expires_at' => null]);
                }
                dump('Update tamamlandı!');
            }

        })->everyMinute(); // hər gün bir dəfə
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}

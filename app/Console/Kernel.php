<?php
namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            // Fetch the last run time from the database
            $lastRun = DB::table('scheduled_jobs')
                ->where('job_name', 'truncate_entre_table')
                ->value('last_run_at');

            // Determine if the job has been missed
            if (!$lastRun || Carbon::parse($lastRun)->lt(Carbon::now()->subDay())) {
                // Truncate the table
                DB::table('entre')->truncate();

                // Update the last run time in the database
                DB::table('scheduled_jobs')->updateOrInsert(
                    ['job_name' => 'truncate_entre_table'],
                    ['last_run_at' => Carbon::now()]
                );
            }
        })->dailyAt('00:00');

    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
<?php

namespace App\Providers;

use App\Console\Commands\CheckStudentsStatus;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            // تشغيل الأمر يوميًا في وقت محدد (مثل منتصف الليل)
            $schedule->command(CheckStudentsStatus::class)->dailyAt('00:00');
            $schedule->command('students:send-study-end-notifications')->dailyAt('01:00');
        });
    }
}

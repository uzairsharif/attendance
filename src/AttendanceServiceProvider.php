<?php

namespace Uzair3\Attendance;

use Illuminate\Support\ServiceProvider;
use Uzair3\Attendance\Console\Commands\CheckOut;


class AttendanceServiceProvider extends ServiceProvider
{
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                CheckOut::class,
            ]);
        }
    }


    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/attendance.php' => config_path('attendance.php'),
        ], 'attendance-config');
        
         // Load package routes
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        // $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        // Load package views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'attendance');

        // $this->publishes([
        //     __DIR__.'/../database/migrations' => database_path('migrations'),
        // ], 'attendance-migrations');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->loadFactoriesFrom(__DIR__.'/../database/factories');
        

        $this->publishes([
            __DIR__.'/../resources/assets' => public_path('uzair3/attendance'),
        ], 'attendance-assets');
    }
}
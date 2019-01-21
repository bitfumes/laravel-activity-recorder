<?php

namespace Bitfumes\Activity;

use Illuminate\Support\ServiceProvider;

class ActivityServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->mergeConfigFrom(__DIR__ . '/../config/activity.php', 'activity');
        $this->publishes([
            __DIR__ . '/../config/activity.php' => config_path('activity.php'),
        ], 'activity:config');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

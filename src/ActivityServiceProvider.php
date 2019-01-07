<?php

namespace Bitfumes\Activity;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Factory;

class ActivityServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerRoutes();
        $this->mergeConfigFrom(__DIR__ . '/../config/Activity.php', 'activity');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
        });
    }

    /**
    * Get the Blogg route group configuration array.
    *
    * @return array
    */
    private function routeConfiguration()
    {
        return [
            'namespace'  => "Bitfumes\Activity\Http\Controllers",
            'middleware' => 'api',
            'prefix'     => 'api'
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadFactories();
    }

    protected function loadFactories()
    {
        $appFactories = scandir(database_path('/factories'));
        $factoryPath  = database_path('factories');
        $this->app->make(Factory::class)->load($factoryPath);
    }
}

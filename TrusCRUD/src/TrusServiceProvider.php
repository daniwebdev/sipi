<?php

namespace TrusCRUD;

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use TrusCRUD\Core\Commands\CrudGenerator;
use TrusCRUD\Core\Commands\CrudRemove;
use TrusCRUD\Core\Commands\Crud;

class TrusServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        //Publish        
        $this->publishes([
            __DIR__.'/../resources/views/templates' => resource_path('views/templates'),
            __DIR__.'/../config/truslabs.php' => config_path('truslabs.php'),
            __DIR__.'/../api' => base_path('api'),
        ], 'truslabs');

        //Loader
        $this->loadViewsFrom(resource_path('views/templates/admin'), 'Admin');
        $this->loadRoutesFrom(__DIR__.'/Core/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/../migrations');

        //HTTPS Schame
        if(conf('force-https')) {
            URL::forceScheme('https');
        }

        //Extend Validator Re-Captcha
        Validator::extend('recaptcha', 'TrusCRUD\\Core\\Validators\\ReCaptcha@validate');

        //Command Console
        if ($this->app->runningInConsole()) {

            $this->commands([Crud::class,CrudRemove::class,CrudGenerator::class]);

        }

    }

    function map() {
        Route::prefix('api')->namespace('\Api\Controllers')->group(base_path('routes/api.php'));
    }
}

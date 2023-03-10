<?php

namespace Teamperm\Providers;

use Illuminate\Support\ServiceProvider;
use Teamperm\Console\Commands\ExampleCommand;
use Teamperm\Console\Commands\MakePackage;

class TeampermServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {


    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        /*
        if ($this->app->runningInConsole()) {
            $this->commands([
                ExampleCommand::class,

            ]);
        }
        */

       // $this->loadViewsFrom(__DIR__ . '/../resources/views', 'teamperm');


        $migrations_path = __DIR__ . '/../copy/migrations';
        if (file_exists($migrations_path)) {
            $this->publishes([
                $migrations_path => database_path('migrations'),
            ], 'public');
        }

        $migrations_path = __DIR__ . '/../copy/Controllers';
        if (file_exists($migrations_path)) {
            $this->publishes([
                $migrations_path => app_path('Http/Controllers'),
            ], 'public');
        }

        $migrations_path = __DIR__ . '/../copy/config';
        if (file_exists($migrations_path)) {
            $this->publishes([
                $migrations_path => app_path('config'),
            ], 'public');
        }

        $migrations_path = __DIR__ . '/../copy/Contracts';
        if (file_exists($migrations_path)) {
            $this->publishes([
                $migrations_path => app_path('Contracts'),
            ], 'public');
        }


        $migrations_path = __DIR__ . '/../copy/Library';
        if (file_exists($migrations_path)) {
            $this->publishes([
                $migrations_path => app_path('Library'),
            ], 'public');
        }


        $migrations_path = __DIR__ . '/../copy/Polls';
        if (file_exists($migrations_path)) {
            $this->publishes([
                $migrations_path => app_path('Polls'),
            ], 'public');
        }

        $migrations_path = __DIR__ . '/../copy/views';
        if (file_exists($migrations_path)) {
            $this->publishes([
                $migrations_path => resource_path('views'),
            ], 'public');
        }


        $js_path = __DIR__ . '/../copy/js';
        if (file_exists($js_path)) {
            $this->publishes([
                $js_path => public_path('js'),
            ], 'public');
        }



    }
}

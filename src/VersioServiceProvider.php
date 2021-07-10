<?php

namespace Structuremedia\Versio;

class VersioServiceProvider extends \Illuminate\Support\ServiceProvider
{

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->bind('versio', function($app) {
            return new Versio();
        });
    }

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/versio.php' => config_path('versio.php'),
        ]);
    }

}

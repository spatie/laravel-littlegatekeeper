<?php

namespace Spatie\LittleGateKeeper;

use Illuminate\Session\Store as Session;
use Illuminate\Support\ServiceProvider;

class LittleGateKeeperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/littlegatekeeper.php' => config_path('littlegatekeeper.php'),
        ], 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/littlegatekeeper.php',
            'littlegatekeeper'
        );

        $this->app->bind(
            Authenticator::class,
            function ($app) {
                return new Authenticator(
                    $app->config->get('littlegatekeeper.username'),
                    $app->config->get('littlegatekeeper.password'),
                    $app->config->get('littlegatekeeper.sessionKey'),
                    $app->make(Session::class)
                );
            },
            true
        );

        $this->app->alias(Authenticator::class, 'littlegatekeeper');
    }
}

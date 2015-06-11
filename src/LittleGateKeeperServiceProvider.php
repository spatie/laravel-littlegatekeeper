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
           __DIR__.'/../config/littlegatekeeper.php', 'littlegatekeeper'
        );

        $this->app->instance(
            Authenticator::class,
            new Authenticator(
                $this->app->config->get('littlegatekeeper.username'),
                $this->app->config->get('littlegatekeeper.password'),
                $this->app->config->get('littlegatekeeper.sessionKey'),
                $this->app->make(Session::class)
            )
        );

        $this->app->alias(Authenticator::class, 'littlegatekeeper');
    }
}

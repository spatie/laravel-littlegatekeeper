<?php

namespace Spatie\LittleGateKeeper;

use Illuminate\Support\ServiceProvider;

class LittleGateKeeperServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->instance(
            Authenticator::class,
            new Authenticator(
                $app->config->get('littlegatekeeper.username'),
                $app->config->get('littlegatekeeper.password'),
                $app->config->get('littlegatekeeper.sessionKey'),
                $app->make('session')
            )
        );

        $this->app->alias(Authenticator::class, 'littlegatekeeper');
    }
}

<?php

namespace Spatie\LittleGateKeeper\Test;

use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\LittleGateKeeper\Authenticator;
use Spatie\LittleGateKeeper\AuthMiddleware;
use Spatie\LittleGateKeeper\LittleGateKeeperServiceProvider;

class TestCase extends Orchestra
{
    /** @var \Illuminate\Contracts\Session\Session */
    public $session;

    /** @var \Spatie\LittleGateKeeper\Authenticator */
    public $authenticator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->app['config']->set('littlegatekeeper.username', 'user');
        $this->app['config']->set('littlegatekeeper.password', 'pass');
        $this->app['config']->set('littlegatekeeper.sessionKey', 'littlegatekeeper.loggedin');
        $this->app['config']->set('littlegatekeeper.authRoute', '/login');

        $this->app['router']->get('/', function () {
            return 'hello world';
        })->middleware(AuthMiddleware::class);

        $this->session = $this->app['session.store'];

        $this->app->forgetInstance(Authenticator::class);

        $this->authenticator = $this->app->make(Authenticator::class);
    }

    protected function getPackageProviders($app)
    {
        return [
            LittleGateKeeperServiceProvider::class,
        ];
    }

    protected function withConfig(array $config)
    {
        $this->app['config']->set($config);

        $this->app->forgetInstance(Authenticator::class);

        $this->authenticator = $this->app->make(Authenticator::class);
    }
}

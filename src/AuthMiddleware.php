<?php

namespace Spatie\LittleGateKeeper;

use Closure;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Routing\Redirector;

class AuthMiddleware
{
    /**
     * @var  \Spatie\LittleGateKeeper\Authenticator
     */
    protected $authenticator;

    /**
     * @var  \Illuminate\Routing\Redirector
     */
    protected $redirector;

    /**
     * @var  \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * @param  \Spatie\LittleGateKeeper\Authenticator $authenticator
     * @param  \Illuminate\Routing\Redirector $redirector
     * @param  \Illuminate\Contracts\Config\Repository $config
     */
    public function __construct(Authenticator $authenticator, Redirector $redirector, Config $config)
    {
        $this->authenticator = $authenticator;
        $this->redirector = $redirector;
        $this->config = $config;
    }

    /**
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! $this->authenticator->isAuthenticated()) {
            return $this->redirector->to($this->config->get('littlegatekeeper.authRoute'));
        }

        return $next($request);
    }
}

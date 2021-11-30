<?php

namespace Spatie\LittleGateKeeper;

use Illuminate\Session\Store as Session;

class Authenticator
{
    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $sessionKey;

    /**
     * @var \Illuminate\Session\Store
     */
    protected $session;

    /**
     * @param  string $username
     * @param  string $password
     * @param  string $sessionKey
     * @param  \Illuminate\Session\Store $session
     */
    public function __construct($username, $password, $sessionKey, Session $session)
    {
        $this->username = $username;
        $this->password = $password;
        $this->sessionKey = $sessionKey;
        $this->session = $session;
    }

    /**
     * @return bool
     */
    public function isAuthenticated()
    {
        return $this->session->has($this->sessionKey);
    }

    /**
     * @param  array $credentials
     * @return bool
     */
    public function attempt($credentials)
    {
        $valid = $this->validateCredentials($credentials);

        if ($valid) {
            $this->login();

            return true;
        }

        return false;
    }

    /**
     * @param  array $credentials  Format: ['username' => '...', 'password' => '...']
     * @return bool
     */
    protected function validateCredentials($credentials)
    {
        if (! isset($credentials['username']) || ! isset($credentials['password'])) {
            return false;
        }

        return ($credentials['username'] === $this->username && $credentials['password'] === $this->password);
    }

    protected function login()
    {
        $this->session->put($this->sessionKey, true);
    }

    public function logout()
    {
        $this->session->forget($this->sessionKey);
    }
}

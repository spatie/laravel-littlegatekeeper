<?php

namespace Spatie\LittleGateKeeper\Test;

class AuthenticatorTest extends TestCase
{
    /** @test */
    public function it_denies_access_without_a_username_and_password_provided()
    {
        $this->session->forget('littlegatekeeper.loggedin');
        $this->get('/')->assertRedirect('/login');
    }

    /** @test */
    public function it_succeeds_authorization_attempt_with_correct_user_and_pass()
    {
        $this->session->put('littlegatekeeper.loggedin', 'true');
        $this->assertTrue($this->authenticator->attempt(['username' => 'user', 'password' => 'pass']));
    }

    /** @test */
    public function it_allows_access_with_a_username_and_password_provided()
    {
        $this->session->put('littlegatekeeper.loggedin', 'true');
        $this->get('/')->assertOk();
    }
}

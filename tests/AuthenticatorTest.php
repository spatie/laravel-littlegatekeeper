<?php

it('denies access without a username and password provided', function () {
    $this->session->forget('littlegatekeeper.loggedin');
    $this->get('/')->assertRedirect('/login');
});

it('succeeds authorization attempt with correct user and password', function () {
    $this->session->put('littlegatekeeper.loggedin', 'true');
    $result = $this->authenticator->attempt(['username' => 'user', 'password' => 'pass']);
    expect($result)->toBeTrue();
});

it('allows access with a username and password provided', function () {
    $this->session->put('littlegatekeeper.loggedin', 'true');
    $this->get('/')->assertOk();
});

it('sets the session key after authorizing', function () {
    $this->authenticator->attempt(['username' => 'user', 'password' => 'pass']);
    $this->get('/')->assertOk();
});

it('does not set the session key after authorizing with incorrect credentials', function () {
    $this->authenticator->attempt(['username' => 'baduser', 'password' => 'badpass']);
    $this->get('/')->assertRedirect('/login');
});

<?php

it('denies access without a username and password provided')
    ->tap(fn () => $this->session->forget('littlegatekeeper.loggedin'))
    ->get('/')->assertRedirect('/login');

it('succeeds authorization attempt with correct user and password')
    ->tap(fn () => $this->session->put('littlegatekeeper.loggedin', 'true'))
    ->expect(fn () => $this->authenticator->attempt(['username' => 'user', 'password' => 'pass']))
    ->toBeTrue();

it('allows access with a username and password provided')
    ->tap(fn () => $this->session->put('littlegatekeeper.loggedin', 'true'))
    ->get('/')->assertOk();

it('sets the session key after authorizing')
    ->tap(fn () => $this->authenticator->attempt(['username' => 'user', 'password' => 'pass']))
    ->get('/')->assertOk();

it('does not set the session key after authorizing with incorrect credentials')
    ->tap(fn () => $this->authenticator->attempt(['username' => 'baduser', 'password' => 'badpass']))
    ->get('/')->assertRedirect('/login');

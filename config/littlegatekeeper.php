<?php

return [
    // Login credentials
    'username' => env('GATEKEEPER_USERNAME', 'default_username'),
    'password' => env('GATEKEEPER_PASSWORD', 'default_password'),

    // The key as which the littlegatekeeper session is stored
    'sessionKey' => 'littlegatekeeper.loggedin',

    // The route to which the middleware redirects if a user isn't authenticated
    'authRoute' => 'auth/login',
];

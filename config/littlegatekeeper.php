<?php

return [
    // Login credentials
    'username' => 'username',
    'password' => 'password',

    // The key as which the littlegatekeeper session is stored
    'sessionKey' => 'littlegatekeeper.loggedin',

    // The route to which the middleware redirects if a user isn't authenticated
    'authRoute' => 'login',
];

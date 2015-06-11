# laravel-littlegatekeeper

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/laravel-littlegatekeeper.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-littlegatekeeper)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/spatie/laravel-littlegatekeeper/master.svg?style=flat-square)](https://travis-ci.org/spatie/laravel-littlegatekeeper)
[![Quality Score](https://img.shields.io/scrutinizer/g/spatie/laravel-littlegatekeeper.svg?style=flat-square)](https://scrutinizer-ci.com/g/spatie/laravel-littlegatekeeper)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-littlegatekeeper.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-littlegatekeeper)

Protect pages from access with a universal username/password combination (set by configuration).

## Install

Via Composer

``` bash
$ composer require spatie/laravel-littlegatekeeper
```

You can install the package via Composer:

```bash
$ composer require spatie/laravel-littlegatekeeper
```

Start by registering the package's the service provider and facade:

```php
// config/app.php (L5)

'providers' => [
  // ...
  'Spatie\LittleGateKeeper\LittleGateKeeperServiceProvider',
],

'aliases' => [
  // ...
  'LittleGateKeeper' => 'Spatie\LittleGateKeeper\LittleGateKeeperFacade',
],
```

Next, publish the config files:

```bash
// L5
$ php artisan vendor:publish --provider="Spatie\LittleGateKeeper\LittleGateKeeperServiceProvider" --tag="config"
```

Finally, register the middleware filter:

```php
// app/Http/Kernel.php

protected $routeMiddleware = [
    // ...
    'littlegatekeeper' => \Spatie\LittleGateKeeper\AuthMiddleware::class,
];
```

## Usage

First set up the username and password in your configuration file.

You can protect your routes with the route filter: 

```php
Route::get('/', ['middleware' => 'littlegatekeeper', function () {
    return view('protectedpage');
}]);
```

If a user isn't logged in, he will be redirected to the url set in the config file (`littlegatekeeper.authRoute`).

### Authenticator methods

```php
/**
 * @param  array $credentials  Format: ['username' => '...', 'password' => '...']
 * @return bool
 */
public function attempt($credentials)
```

```php
/**
 * @return bool
 */
public function isAuthenticated()
```

```php
protected function logout()
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email freek@spatie.be instead of using the issue tracker.

## Credits

- [Sebastian De Deyne](https://github.com/sebastiandedeyne)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

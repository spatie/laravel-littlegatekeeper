# laravel-littlegatekeeper

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/laravel-littlegatekeeper.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-littlegatekeeper)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![run-tests](https://github.com/spatie/laravel-littlegatekeeper/actions/workflows/run-tests.yml/badge.svg)](https://github.com/spatie/laravel-littlegatekeeper/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-littlegatekeeper.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-littlegatekeeper)

Protect pages from access with a universal username/password combination (set by configuration).

Spatie is a webdesign agency in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-littlegatekeeper.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-littlegatekeeper)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Postcardware

You're free to use this package (it's [MIT-licensed](LICENSE.md)), but if it makes it to your production environment you are required to send us a postcard from your hometown, mentioning which of our package(s) you are using.

Our address is: Spatie, Kruikstraat 22, 2018 Antwerp, Belgium.

The best postcards will get published on the open source page on our website.

## Install

You can install the package via Composer:

```bash
$ composer require spatie/laravel-littlegatekeeper
```

Start by registering the package's the service provider:

```php
// config/app.php (L5)

'providers' => [
  // ...
  'Spatie\LittleGateKeeper\LittleGateKeeperServiceProvider',
],
```

Next, publish the config files:

```bash
$ php artisan vendor:publish --provider="Spatie\LittleGateKeeper\LittleGateKeeperServiceProvider" --tag="config"
```

Finally, register the middleware:

```php
// app/Http/Kernel.php

protected $routeMiddleware = [
    // ...
    'littlegatekeeper' => \Spatie\LittleGateKeeper\AuthMiddleware::class,
];
```

## Usage

First set up the username and password in your configuration file or .env file

In your .env file add:
```php
// ...
GATEKEEPER_USERNAME=Choose_your_username
GATEKEEPER_PASSWORD=Choose_your_secret_password
```

You can protect your routes by applying the middleware:

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

## About Spatie
Spatie is a webdesign agency in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

# PHP Sqreen API Client

[![Latest Version on Packagist](https://img.shields.io/packagist/v/m1guelpf/sqreen-api.svg?style=flat-square)](https://packagist.org/packages/m1guelpf/sqreen-api)
[![Software License](https://img.shields.io/github/license/m1guelpf/php-sqreen-api.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/m1guelpf/php-sqreen-api/master.svg?style=flat-square)](https://travis-ci.org/m1guelpf/php-sqreen-api)
[![Total Downloads](https://img.shields.io/packagist/dt/m1guelpf/sqreen-api.svg?style=flat-square)](https://packagist.org/packages/m1guelpf/sqreen-api)

This package makes it easy to interact with [the Sqreen API](https://doc.sqreen.io/reference).

## Requirements

This package requires PHP >= 5.5 or PHP >= 7.

## Installation

You can install the package via composer:

``` bash
composer require m1guelpf/sqreen-api dev-master
```

## Usage

You must pass a Guzzle client and the API token to the constructor of `M1guelpf\SqreenAPI\Sqreen`.

``` php
$sqreen = new \M1guelpf\SqreenAPI\Sqreen('YOUR_SQREEN_API_TOKEN');
```

or you can skip the token and use the `connect()` method later

``` php
$sqreen = new \M1guelpf\SqreenAPI\Sqreen();

$sqreen->connect('YOUR_SQREEN_API_TOKEN');
```

### Get Email info
``` php
$sqreen->emails($email);
```

### Get IP info
``` php
$sqreen->ips($ip);
```

### Get the Guzzle Client

``` php
$sqreen->getClient();
```

### Set the Guzzle Client

``` php
$client = new \GuzzleHttp\Client(); // Example Guzzle client
$sqreen->setClient($client);
```
where $client is an instance of `\GuzzleHttp\Client`.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email soy@miguelpiedrafita.com instead of using the issue tracker.

## Credits

- [Miguel Piedrafita](https://github.com/m1guelpf)
- [All Contributors](../../contributors)

## License

The Mozilla Public License 2.0 (MPL-2.0). Please see [License File](LICENSE.md) for more information.

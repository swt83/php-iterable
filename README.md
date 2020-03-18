# Iterable

A PHP package for working w/ the Iterable API.

## Install

Normal install via Composer.

## Usage

Call the ``run()`` method and pass the api key, the api secret, the method name, and an array of arguments:

```php
use Travis\IterableAPI;

$key = 'yourapikey';

$response = IterableAPI::run($key, 'GET', 'user/foobar@foobar.net', []);
```

See the [API Guide](https://api.iterable.com/api/docs) for additional methods.

## Notes

The word ``iterable`` is a reserved word in PHP.
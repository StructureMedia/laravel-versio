# Laravel Versio

Laravel 8 package for communicating with the API from versio.nl

Based on the works of: https://github.com/Cannonb4ll/LaravelVersio

## Installation 

You can install the package through Composer.
```bash
composer require structuremedia/laravel-versio
```

Then publish the config and migration file of the package using artisan.
```bash
php artisan vendor:publish --provider="Structuremedia\Versio\VersioServiceProvider"
```
And adjust config file (`config/versio.php`) with your desired settings.

## Usage

All that is left to do is to define 3 ENV configuration variables.

```
VERSIO_EMAIL=
VERSIO_PASSWORD=
VERSIO_TEST=
```

Next you can use it like this:

```php
$versio = Versio::domains()->list();
```

## Limitations

At this point the following modules are available:
- Contact
- Domain
- Tld

## Documentation

You will have to get the API documentation from VERSIO to see what you can fill in the arrays:
https://www.versio.nl/RESTapidoc/

## License

The laravel versio package is open source software licensed under the [license MIT](http://opensource.org/licenses/MIT)

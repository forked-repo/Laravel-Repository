# Laravel Repository

Fork of https://github.com/andersao/l5-repository.

## Table of Contents

- <a href="#installation">Installation</a>
- <a href="#methods">Methods</a>
- <a href="#usage">Usage</a>
- <a href="#cache">Cache</a>
- <a href="#validators">Validators</a>
- <a href="#presenters">Presenters</a>

## Installation

### Composer

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```terminal
$ composer require faustbrian/laravel-repository
```

### Laravel

And then include the service provider within `app/config/app.php`.

```php
BrianFaust\Repository\LaravelRepositoryServiceProvider::class,
```

To get started, you'll need to publish the vendor assets:

```shell
php artisan vendor:publish --provider="BrianFaust\Repository\LaravelRepositoryServiceProvider"
```

### Lumen

And then include the service provider within `bootstrap/app.php`.

```php
$app->register(BrianFaust\Repository\LumenRepositoryServiceProvider::class);
```

To get started, you'll need to publish the vendor assets:

```shell
php artisan vendor:publish --provider="BrianFaust\Repository\LumenRepositoryServiceProvider"
```

## Usage

- [Methods](docs/methods.md)
- [Usage](docs/usage.md)
- [Generators](docs/generators.md)
- [Methods Usage](docs/methods-usage.md)
- [Criteria](docs/criteria.md)
- [Cache](docs/cache.md)
- [Validators](docs/validators.md)
- [Presenters & Transformers](docs/presenters-transformers.md)

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ phpunit
```

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security

If you discover a security vulnerability within this package, please send an e-mail to Brian Faust at hello@brianfaust.de. All security vulnerabilities will be promptly addressed.

## Credits

- [Brian Faust](https://github.com/faustbrian)
- [All Contributors](../../contributors)

## License

[MIT](LICENSE) © [Brian Faust](https://brianfaust.de)

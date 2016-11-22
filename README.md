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
'providers' => [
    ...
    BrianFaust\Repository\Providers\RepositoryServiceProvider::class,
],
```

To get started, you'll need to publish the vendor assets:

```shell
php artisan vendor:publish --provider="BrianFaust\Repository\Providers\RepositoryServiceProvider"
```

### Lumen

And then include the service provider within `bootstrap/app.php`.

```php
$app->register(BrianFaust\Repository\Providers\LumenRepositoryServiceProvider::class);
```

To get started, you'll need to publish the vendor assets:

```shell
php artisan vendor:publish --provider="BrianFaust\Repository\Providers\LumenRepositoryServiceProvider"
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

## Security

If you discover a security vulnerability within this package, please send an e-mail to Brian Faust at hello@brianfaust.de. All security vulnerabilities will be promptly addressed.

## License

The [The MIT License (MIT)](LICENSE). Please check the [LICENSE](LICENSE) file for more details.

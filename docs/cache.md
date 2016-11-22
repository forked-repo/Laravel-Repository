## Table of Contents

- <a href="#cache">Cache</a>
    - <a href="#cache-usage">Usage</a>
    - <a href="#cache-config">Config</a>

### Cache

Add a layer of cache easily to your repository

#### Cache Usage

Implements the interface CacheableInterface and use CacheableRepository Trait.

```php
use BrianFaust\Repository\Eloquent\BaseRepository;
use BrianFaust\Repository\Contracts\CacheableInterface;
use BrianFaust\Repository\Traits\CacheableRepository;

class PostRepository extends BaseRepository implements CacheableInterface {

    use CacheableRepository;

    ...
}
```

Done , done that your repository will be cached , and the repository cache is cleared whenever an item is created, modified or deleted.

#### Cache Config

You can change the cache settings in the file *config/repository.php* and also directly on your repository.

*config/repository.php*

```php
'cache'=>[
    //Enable or disable cache repositories
    'enabled'   => true,

    //Lifetime of cache
    'minutes'   => 30,

    //Repository Cache, implementation Illuminate\Contracts\Cache\Repository
    'repository'=> 'cache',

    //Sets clearing the cache
    'clean'     => [
        //Enable, disable clearing the cache on changes
        'enabled' => true,

        'on' => [
            //Enable, disable clearing the cache when you create an item
            'create'=>true,

            //Enable, disable clearing the cache when upgrading an item
            'update'=>true,

            //Enable, disable clearing the cache when you delete an item
            'delete'=>true,
        ]
    ],
    'params' => [
        //Request parameter that will be used to bypass the cache repository
        'skipCache'=>'skipCache'
    ],
    'allowed'=>[
        //Allow caching only for some methods
        'only'  =>null,

        //Allow caching for all available methods, except
        'except'=>null
    ],
],
```

It is possible to override these settings directly in the repository.

```php
use BrianFaust\Repository\Eloquent\BaseRepository;
use BrianFaust\Repository\Contracts\CacheableInterface;
use BrianFaust\Repository\Traits\CacheableRepository;

class PostRepository extends BaseRepository implements CacheableInterface {

    // Setting the lifetime of the cache to a repository specifically
    protected $cacheMinutes = 90;

    protected $cacheOnly = ['all', ...];
    //or
    protected $cacheExcept = ['find', ...];

    use CacheableRepository;

    ...
}
```

The cacheable methods are : all, paginate, find, findByField, findWhere, getByCriteria

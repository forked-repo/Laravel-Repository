## Table of Contents

- <a href="#presenters">Presenters</a>
    - <a href="#fractal-presenter">Fractal Presenter</a>
        - <a href="#create-a-presenter">Create a Fractal Presenter</a>
        - <a href="#implement-interface">Model Transformable</a>
    - <a href="#enabling-in-your-repository-1">Enabling in your Repository</a>

### Presenters

Presenters function as a wrapper and renderer for objects.

#### Fractal Presenter

Requires [Fractal](http://fractal.thephpleague.com/). `composer require league/fractal`

There are two ways to implement the Presenter, the first is creating a TransformerAbstract and set it using your Presenter class as described in the Create a Transformer Class.

The second way is to make your model implement the Transformable interface, and use the default Presenter ModelFractarPresenter, this will have the same effect.

##### Transformer Class

###### Create a Transformer using the command

```terminal
php artisan make:transformer Post
```

This wil generate the class beneath.

###### Create a Transformer Class

```php
use League\Fractal\TransformerAbstract;

class PostTransformer extends TransformerAbstract
{
    public function transform(\Post $post)
    {
        return [
            'id'      => (int) $post->id,
            'title'   => $post->title,
            'content' => $post->content
        ];
    }
}
```

###### Create a Presenter using the command

```terminal
php artisan make:presenter Post
```

The command will prompt you for creating a Transformer too if you haven't already.
###### Create a Presenter

```php
use BrianFaust\Repository\Presenter\FractalPresenter;

class PostPresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PostTransformer();
    }
}
```

###### Enabling in your Repository

```php
use BrianFaust\Repository\Eloquent\BaseRepository;

class PostRepository extends BaseRepository {

    ...

    public function presenter()
    {
        return "App\\Presenter\\PostPresenter";
    }
}
```

Or enable it in your controller with

```php
$this->repository->setPresenter("App\\Presenter\\PostPresenter");
```

###### Using the presenter after from the Model

If you recorded a presenter and sometime used the `skipPresenter()` method or simply you do not want your result is not changed automatically by the presenter.
You can implement Presentable interface on your model so you will be able to present your model at any time. See below:

In your model, implement the interface `BrianFaust\Repository\Contracts\Presentable` and `BrianFaust\Repository\Traits\PresentableTrait`

```php
namespace App;

use BrianFaust\Repository\Contracts\Presentable;
use BrianFaust\Repository\Traits\PresentableTrait;

class Post extends Eloquent implements Presentable {

    use PresentableTrait;

    protected $fillable = [
        'title',
        'author',
        ...
     ];

     ...
}
```

There, now you can submit your Model individually, See an example:

```php
$repository = app('App\PostRepository');
$repository->setPresenter("BrianFaust\\Repository\\Presenter\\ModelFractalPresenter");

//Getting the result transformed by the presenter directly in the search
$post = $repository->find(1);

print_r( $post ); //It produces an output as array

...

//Skip presenter and bringing the original result of the Model
$post = $repository->skipPresenter()->find(1);

print_r( $post ); //It produces an output as a Model object
print_r( $post->presenter() ); //It produces an output as array

```

You can skip the presenter at every visit and use it on demand directly into the model, for it set the `$skipPresenter` attribute to true in your repository:

```php
use BrianFaust\Repository\Eloquent\BaseRepository;

class PostRepository extends BaseRepository {

    /**
    * @var bool
    */
    protected $skipPresenter = true;

    public function presenter()
    {
        return "App\\Presenter\\PostPresenter";
    }
}
```

##### Model Class

###### Implement Interface

```php
namespace App;

use BrianFaust\Repository\Contracts\Transformable;

class Post extends Eloquent implements Transformable {
     ...
     /**
      * @return array
      */
     public function transform()
     {
         return [
             'id'      => (int) $this->id,
             'title'   => $this->title,
             'content' => $this->content
         ];
     }
}
```

###### Enabling in your Repository

`BrianFaust\Repository\Presenter\ModelFractalPresenter` is a Presenter default for Models implementing Transformable

```php
use BrianFaust\Repository\Eloquent\BaseRepository;

class PostRepository extends BaseRepository {

    ...

    public function presenter()
    {
        return "BrianFaust\\Repository\\Presenter\\ModelFractalPresenter";
    }
}
```

Or enable it in your controller with

```php
$this->repository->setPresenter("BrianFaust\\Repository\\Presenter\\ModelFractalPresenter");
```

### Skip Presenter defined in the repository

Use *skipPresenter* before any other chaining method

```php
$posts = $this->repository->skipPresenter()->all();
```

or

```php
$this->repository->skipPresenter();

$posts = $this->repository->all();
```

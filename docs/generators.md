## Table of Contents

- <a href="#generators">Generators</a>

### Generators

Create your repositories easily through the generator.

#### Config

You must first configure the storage location of the repository files. By default is the "app" folder and the namespace "App". Please note that, values in the `paths` array are acutally used as both *namespace* and file paths. Relax though, both foreward and backward slashes are taken care of during generation.

```php
    ...
    'generator'=>[
        'basePath'=>app()->path(),
        'rootNamespace'=>'App\\',
        'paths'=>[
            'models'       => 'Entities',
            'repositories' => 'Repositories',
            'interfaces'   => 'Repositories',
            'transformers' => 'Transformers',
            'presenters'   => 'Presenters',
            'validators'   => 'Validators',
            'controllers'  => 'Http/Controllers',
            'provider'     => 'RepositoryServiceProvider',
            'criteria'     => 'Criteria',
        ]
    ]
```

You may want to save the root of your project folder out of the app and add another namespace, for example

```php
    ...
     'generator'=>[
        'basePath'      => base_path('src/Lorem'),
        'rootNamespace' => 'Lorem\\'
    ]
```

Additionally, you may wish to customize where your generated classes end up being saved.  That can be accomplished by editing the `paths` node to your liking.  For example:

```php
    'generator'=>[
        'basePath'=>app()->path(),
        'rootNamespace'=>'App\\',
        'paths'=>[
            'models'=>'Models',
            'repositories'=>'Repositories\\Eloquent',
            'interfaces'=>'Contracts\\Repositories',
            'transformers'=>'Transformers',
            'presenters'=>'Presenters'
            'validators'   => 'Validators',
            'controllers'  => 'Http/Controllers',
            'provider'     => 'RepositoryServiceProvider',
            'criteria'     => 'Criteria',
        ]
    ]
```

#### Commands

To generate everything you need for your Model, run this command:

```terminal
php artisan make:entity Post
```

This will create the Controller, the Validator, the Model, the Repository, the Presenter and the Transformer classes.
It will also create a new service provider that will be used to bind the Eloquent Repository with its corresponding Repository Interface.
To load it, just add this to your AppServiceProvider@register method:

```php
    $this->app->register(RepositoryServiceProvider::class);
```

You can also pass the options from the ```repository``` command, since this command is just a wrapper.

To generate a repository for your Post model, use the following command

```terminal
php artisan make:repository Post
```

To generate a repository for your Post model with Blog namespace, use the following command

```terminal
php artisan make:repository "Blog\Post"
```

Added fields that are fillable

```terminal
php artisan make:repository "Blog\Post" --fillable="title,content"
```

To add validations rules directly with your command you need to pass the `--rules` option and create migrations as well:

```terminal
php artisan make:entity Cat --fillable="title:string,content:text" --rules="title=>required|min:2, content=>sometimes|min:10"
```

The command will also create your basic RESTfull controller so just add this line into your `routes.php` file and you will have a basic CRUD:

 ```php
 Route::resource('cats', CatsController::class);
 ```

When running the command, you will be creating the "Entities" folder and "Repositories" inside the folder that you set as the default.

Done, done that just now you do bind its interface for your real repository, for example in your own Repositories Service Provider.

```php
App::bind('{YOUR_NAMESPACE}Repositories\PostRepository', '{YOUR_NAMESPACE}Repositories\PostRepositoryEloquent');
```

And use

```php
public function __construct({YOUR_NAMESPACE}Repositories\PostRepository $repository){
    $this->repository = $repository;
}
```

Alternatively, you could use the artisan command to do the binding for you.

```php
php artisan make:bindings Cats
```

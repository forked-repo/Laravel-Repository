## Table of Contents

- <a href="#create-a-criteria">Create a Criteria</a>
- <a href="#using-the-criteria-in-a-controller">Using the Criteria in a Controller</a>
- <a href="#using-the-requestcriteria">Using the RequestCriteria</a>
-
### Create a Criteria

#### Using the command

```terminal
php artisan make:criteria My
```

Criteria are a way to change the repository of the query by applying specific conditions according to your needs. You can add multiple Criteria in your repository.

```php

use BrianFaust\Repository\Contracts\RepositoryInterface;
use BrianFaust\Repository\Contracts\CriteriaInterface;

class MyCriteria implements CriteriaInterface {

    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->where('user_id','=', Auth::user()->id );
        return $model;
    }
}
```

### Using the Criteria in a Controller

```php

namespace App\Http\Controllers;

use App\PostRepository;

class PostsController extends BaseController {

    /**
     * @var PostRepository
     */
    protected $repository;

    public function __construct(PostRepository $repository){
        $this->repository = $repository;
    }


    public function index()
    {
        $this->repository->pushCriteria(new MyCriteria1());
        $this->repository->pushCriteria(MyCriteria2::class);
        $posts = $this->repository->all();
        ...
    }

}
```

Getting results from Criteria

```php
$posts = $this->repository->getByCriteria(new MyCriteria());
```

Setting the default Criteria in Repository

```php
use BrianFaust\Repository\Eloquent\BaseRepository;

class PostRepository extends BaseRepository {

    public function boot(){
        $this->pushCriteria(new MyCriteria());
        // or
        $this->pushCriteria(AnotherCriteria::class);
        ...
    }

    function model(){
       return "App\\Post";
    }
}
```

### Skip criteria defined in the repository

Use `skipCriteria` before any other chaining method

```php
$posts = $this->repository->skipCriteria()->all();
```

### Popping criteria

Use `popCriteria` to remove a criteria

```php
$this->repository->popCriteria(new Criteria1());
// or
$this->repository->popCriteria(Criteria1::class);
```


### Using the RequestCriteria

RequestCriteria is a standard Criteria implementation. It enables filters to perform in the repository from parameters sent in the request.

You can perform a dynamic search, filter the data and customize the queries.

To use the Criteria in your repository, you can add a new criteria in the boot method of your repository, or directly use in your controller, in order to filter out only a few requests.

####Enabling in your Repository

```php
use BrianFaust\Repository\Eloquent\BaseRepository;
use BrianFaust\Repository\Criteria\RequestCriteria;


class PostRepository extends BaseRepository {

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email'
    ];

    public function boot(){
        $this->pushCriteria(app('BrianFaust\Repository\Criteria\RequestCriteria'));
        ...
    }

    function model(){
       return "App\\Post";
    }
}
```

Remember, you need to define which fields from the model can be searchable.

In your repository set **$fieldSearchable** with the name of the fields to be searchable or a relation to fields.

```php
protected $fieldSearchable = [
    'name',
    'email',
    'product.name'
];
```

You can set the type of condition which will be used to perform the query, the default condition is "**=**"

```php
protected $fieldSearchable = [
    'name'=>'like',
    'email', // Default Condition "="
    'your_field'=>'condition'
];
```


####Enabling in your Controller

```php
    public function index()
    {
        $this->repository->pushCriteria(app('BrianFaust\Repository\Criteria\RequestCriteria'));
        $posts = $this->repository->all();
        ...
    }
```

#### Example the Criteria

Request all data without filter by request

`http://prettus.local/users`

```json
[
    {
        "id": 1,
        "name": "John Doe",
        "email": "john@gmail.com",
        "created_at": "-0001-11-30 00:00:00",
        "updated_at": "-0001-11-30 00:00:00"
    },
    {
        "id": 2,
        "name": "Lorem Ipsum",
        "email": "lorem@ipsum.com",
        "created_at": "-0001-11-30 00:00:00",
        "updated_at": "-0001-11-30 00:00:00"
    },
    {
        "id": 3,
        "name": "Laravel",
        "email": "laravel@gmail.com",
        "created_at": "-0001-11-30 00:00:00",
        "updated_at": "-0001-11-30 00:00:00"
    }
]
```

Conducting research in the repository

`http://prettus.local/users?search=John%20Doe`

or

`http://prettus.local/users?search=John&searchFields=name:like`

or

`http://prettus.local/users?search=john@gmail.com&searchFields=email:=`

or

`http://prettus.local/users?search=name:John Doe;email:john@gmail.com`

or

`http://prettus.local/users?search=name:John;email:john@gmail.com&searchFields=name:like;email:=`

```json
[
    {
        "id": 1,
        "name": "John Doe",
        "email": "john@gmail.com",
        "created_at": "-0001-11-30 00:00:00",
        "updated_at": "-0001-11-30 00:00:00"
    }
]
```

Filtering fields

`http://prettus.local/users?filter=id;name`

```json
[
    {
        "id": 1,
        "name": "John Doe"
    },
    {
        "id": 2,
        "name": "Lorem Ipsum"
    },
    {
        "id": 3,
        "name": "Laravel"
    }
]
```

Sorting the results

`http://prettus.local/users?filter=id;name&orderBy=id&sortedBy=desc`

```json
[
    {
        "id": 3,
        "name": "Laravel"
    },
    {
        "id": 2,
        "name": "Lorem Ipsum"
    },
    {
        "id": 1,
        "name": "John Doe"
    }
]
```

Sorting through related tables

`http://prettus.local/users?orderBy=posts|title&sortedBy=desc`

Query will have something like this

```sql
...
INNER JOIN posts ON users.post_id = posts.id
...
ORDER BY title
...
```

`http://prettus.local/users?orderBy=posts:custom_id|posts.title&sortedBy=desc`

Query will have something like this

```sql
...
INNER JOIN posts ON users.custom_id = posts.id
...
ORDER BY posts.title
...
```


Add relationship

`http://prettus.local/users?with=groups`



####Overwrite params name

You can change the name of the parameters in the configuration file **config/repository.php**

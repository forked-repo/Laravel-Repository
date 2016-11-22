## Table of Contents

- <a href="#validators">Validators</a>
    - <a href="#using-a-validator-class">Using a Validator Class</a>
        - <a href="#create-a-validator">Create a Validator</a>
        - <a href="#enabling-validator-in-your-repository-1">Enabling Validator in your Repository</a>
    - <a href="#defining-rules-in-the-repository">Defining rules in the repository</a>

### Validators

Requires [prettus/laravel-validator](https://github.com/prettus/laravel-validator). `composer require prettus/laravel-validator`

Easy validation with `prettus/laravel-validator`

[For more details click here](https://github.com/prettus/laravel-validator)

#### Using a Validator Class

##### Create a Validator

In the example below, we define some rules for both creation and edition

```php
use \BrianFaust\Validator\LaravelValidator;

class PostValidator extends LaravelValidator {

    protected $rules = [
        'title' => 'required',
        'text'  => 'min:3',
        'author'=> 'required'
    ];

}
```

To define specific rules, proceed as shown below:

```php
use \BrianFaust\Validator\Contracts\ValidatorInterface;
use \BrianFaust\Validator\LaravelValidator;

class PostValidator extends LaravelValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'title' => 'required',
            'text'  => 'min:3',
            'author'=> 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'title' => 'required'
        ]
   ];

}
```

##### Enabling Validator in your Repository

```php
use BrianFaust\Repository\Eloquent\BaseRepository;
use BrianFaust\Repository\Criteria\RequestCriteria;

class PostRepository extends BaseRepository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model(){
       return "App\\Post";
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {
        return "App\\PostValidator";
    }
}
```

#### Defining rules in the repository

Alternatively, instead of using a class to define its validation rules, you can set your rules directly into the rules repository property, it will have the same effect as a Validation class.

```php
use BrianFaust\Repository\Eloquent\BaseRepository;
use BrianFaust\Repository\Criteria\RequestCriteria;
use BrianFaust\Validator\Contracts\ValidatorInterface;

class PostRepository extends BaseRepository {

    /**
     * Specify Validator Rules
     * @var array
     */
     protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'title' => 'required',
            'text'  => 'min:3',
            'author'=> 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'title' => 'required'
        ]
   ];

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model(){
       return "App\\Post";
    }

}
```

Validation is now ready. In case of a failure an exception will be given of the type: *BrianFaust\Validator\Exceptions\ValidatorException*

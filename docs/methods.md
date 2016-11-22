## Table of Contents

- <a href="#methods">Methods</a>
    - <a href="#faustbrianrepositorycontractsrepositoryinterface">RepositoryInterface</a>
    - <a href="#faustbrianrepositorycontractsrepositorycriteriainterface">RepositoryCriteriaInterface</a>
    - <a href="#faustbrianrepositorycontractscacheableinterface">CacheableInterface</a>
    - <a href="#faustbrianrepositorycontractspresenterinterface">PresenterInterface</a>
    - <a href="#faustbrianrepositorycontractscriteriainterface">CriteriaInterface</a>

## Methods

### BrianFaust\Repository\Contracts\RepositoryInterface

- all($columns = array('*'))
- first($columns = array('*'))
- paginate($limit = null, $columns = ['*'], $pageName = 'page')
- find($id, $columns = ['*'])
- findByField($field, $value, $columns = ['*'])
- findWhere(array $where, $columns = ['*'])
- findWhereIn($field, array $where, $columns = [*])
- findWhereNotIn($field, array $where, $columns = [*])
- create(array $attributes)
- update(array $attributes, $id)
- updateOrCreate(array $attributes, array $values = [])
- delete($id)
- deleteWhere(array $where)
- orderBy($column, $direction = 'asc')
- with(array $relations)
- hidden(array $fields)
- visible(array $fields)
- scopeQuery(Closure $scope)
- getFieldsSearchable()
- setPresenter($presenter)
- skipPresenter($status = true)


### BrianFaust\Repository\Contracts\RepositoryCriteriaInterface

- pushCriteria($criteria)
- popCriteria($criteria)
- getCriteria()
- getByCriteria(CriteriaInterface $criteria)
- skipCriteria($status = true)
- getFieldsSearchable()

### BrianFaust\Repository\Contracts\CacheableInterface

- setCacheRepository(CacheRepository $repository)
- getCacheRepository()
- getCacheKey($method, $args = null)
- getCacheMinutes()
- skipCache($status = true)

### BrianFaust\Repository\Contracts\PresenterInterface

- present($data);

### BrianFaust\Repository\Contracts\Presentable

- setPresenter(PresenterInterface $presenter);
- presenter();

### BrianFaust\Repository\Contracts\CriteriaInterface

- apply($model, RepositoryInterface $repository);

### BrianFaust\Repository\Contracts\Transformable

- transform();

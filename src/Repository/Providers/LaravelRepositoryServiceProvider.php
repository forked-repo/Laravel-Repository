<?php

namespace BrianFaust\Repository\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider.
 */
class LaravelRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../../resources/config/repository.php' => config_path('repository.php'),
        ]);

        $this->mergeConfigFrom(__DIR__.'/../../../resources/config/repository.php', 'repository');

        $this->loadTranslationsFrom(__DIR__.'/../../../resources/lang', 'repository');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->commands('BrianFaust\Repository\Generators\Commands\RepositoryCommand');
        $this->commands('BrianFaust\Repository\Generators\Commands\TransformerCommand');
        $this->commands('BrianFaust\Repository\Generators\Commands\PresenterCommand');
        $this->commands('BrianFaust\Repository\Generators\Commands\EntityCommand');
        $this->commands('BrianFaust\Repository\Generators\Commands\ValidatorCommand');
        $this->commands('BrianFaust\Repository\Generators\Commands\ControllerCommand');
        $this->commands('BrianFaust\Repository\Generators\Commands\BindingsCommand');
        $this->commands('BrianFaust\Repository\Generators\Commands\CriteriaCommand');
        $this->app->register('BrianFaust\Repository\Providers\EventServiceProvider');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}

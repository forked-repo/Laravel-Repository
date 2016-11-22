<?php

namespace BrianFaust\Repository\Providers;

use BrianFaust\Repository\Generators\Commands\ControllerCommand;
use BrianFaust\Repository\Generators\Commands\EntityCommand;
use BrianFaust\Repository\Generators\Commands\PresenterCommand;
use BrianFaust\Repository\Generators\Commands\RepositoryCommand;
use BrianFaust\Repository\Generators\Commands\TransformerCommand;
use BrianFaust\Repository\Generators\Commands\ValidatorCommand;
use Illuminate\Support\ServiceProvider;

/**
 * Class LumenRepositoryServiceProvider.
 */
class LumenRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->commands(RepositoryCommand::class);
        $this->commands(TransformerCommand::class);
        $this->commands(PresenterCommand::class);
        $this->commands(EntityCommand::class);
        $this->commands(ValidatorCommand::class);
        $this->commands(ControllerCommand::class);
        $this->app->register(EventServiceProvider::class);

        $this->app->configure('repository');
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

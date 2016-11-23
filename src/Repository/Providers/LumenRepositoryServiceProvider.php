<?php

namespace BrianFaust\Repository\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class LumenRepositoryServiceProvider.
 */
class LumenRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->commands([
            Generators\Commands\RepositoryCommand::class,
            Generators\Commands\TransformerCommand::class,
            Generators\Commands\PresenterCommand::class,
            Generators\Commands\EntityCommand::class,
            Generators\Commands\ValidatorCommand::class,
            Generators\Commands\ControllerCommand::class,
        ]);

        $this->app->register(EventServiceProvider::class);

        $this->app->configure('repository');
    }
}

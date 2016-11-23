<?php

/*
 * This file is part of Laravel Repository.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Repository\Providers;

use BrianFaust\ServiceProvider\ServiceProvider;

/**
 * Class LaravelRepositoryServiceProvider.
 */
class LaravelRepositoryServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishConfig();
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->mergeConfig();

        $this->commands([
            Generators\Commands\RepositoryCommand::class,
            Generators\Commands\TransformerCommand::class,
            Generators\Commands\PresenterCommand::class,
            Generators\Commands\EntityCommand::class,
            Generators\Commands\ValidatorCommand::class,
            Generators\Commands\ControllerCommand::class,
            Generators\Commands\BindingsCommand::class,
            Generators\Commands\CriteriaCommand::class,
        ]);

        $this->app->register(Providers\EventServiceProvider::class);
    }

    /**
     * @return string
     */
    protected function getPackageName()
    {
        return 'laravel-repository';
    }
}

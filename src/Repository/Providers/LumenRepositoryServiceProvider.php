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

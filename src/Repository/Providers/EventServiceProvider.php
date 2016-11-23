<?php

namespace BrianFaust\Repository\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class EventServiceProvider.
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'BrianFaust\Repository\Events\RepositoryEntityCreated' => [
            'BrianFaust\Repository\Listeners\CleanCacheRepository',
        ],
        'BrianFaust\Repository\Events\RepositoryEntityUpdated' => [
            'BrianFaust\Repository\Listeners\CleanCacheRepository',
        ],
        'BrianFaust\Repository\Events\RepositoryEntityDeleted' => [
            'BrianFaust\Repository\Listeners\CleanCacheRepository',
        ],
    ];

    /**
     * Register the application's event listeners.
     */
    public function boot()
    {
        $events = app('events');

        foreach ($this->listen as $event => $listeners) {
            foreach ($listeners as $listener) {
                $events->listen($event, $listener);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
    }

    /**
     * Get the events and handlers.
     *
     * @return array
     */
    public function listens()
    {
        return $this->listen;
    }
}

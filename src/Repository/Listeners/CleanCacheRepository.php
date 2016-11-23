<?php

namespace BrianFaust\Repository\Listeners;

use BrianFaust\Repository\Contracts\RepositoryInterface;
use BrianFaust\Repository\Events\RepositoryEventBase;
use BrianFaust\Repository\Helpers\CacheKeys;
use Illuminate\Contracts\Cache\Repository as CacheRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

/**
 * Class CleanCacheRepository.
 */
class CleanCacheRepository
{
    /**
     * @var CacheRepository
     */
    protected $cache = null;

    /**
     * @var RepositoryInterface
     */
    protected $repository = null;

    /**
     * @var Model
     */
    protected $model = null;

    /**
     * @var string
     */
    protected $action = null;

    /**
     * CleanCacheRepository constructor.
     */
    public function __construct()
    {
        $this->cache = app(config('repository.cache.repository', 'cache'));
    }

    /**
     * @param RepositoryEventBase $event
     */
    public function handle(RepositoryEventBase $event)
    {
        try {
            $cleanEnabled = config('repository.cache.clean.enabled', true);

            if ($cleanEnabled) {
                $this->repository = $event->getRepository();
                $this->model = $event->getModel();
                $this->action = $event->getAction();

                if (config("repository.cache.clean.on.{$this->action}", true)) {
                    $cacheKeys = CacheKeys::getKeys(get_class($this->repository));

                    if (is_array($cacheKeys)) {
                        foreach ($cacheKeys as $key) {
                            $this->cache->forget($key);
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}

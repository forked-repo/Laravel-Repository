<?php

namespace BrianFaust\Repository\Events;

/**
 * Class RepositoryEntityDeleted.
 */
class RepositoryEntityDeleted extends RepositoryEventBase
{
    /**
     * @var string
     */
    protected $action = 'deleted';
}

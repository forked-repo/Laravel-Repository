<?php

namespace BrianFaust\Repository\Events;

/**
 * Class RepositoryEntityUpdated.
 */
class RepositoryEntityUpdated extends RepositoryEventBase
{
    /**
     * @var string
     */
    protected $action = 'updated';
}

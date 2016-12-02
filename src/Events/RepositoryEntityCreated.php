<?php

/*
 * This file is part of Laravel Repository.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Repository\Events;

/**
 * Class RepositoryEntityCreated.
 */
class RepositoryEntityCreated extends RepositoryEventBase
{
    /**
     * @var string
     */
    protected $action = 'created';
}

<?php

/*
 * This file is part of Laravel Repository.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Repository\Contracts;

/**
 * Interface Transformable.
 */
interface Transformable
{
    /**
     * @return array
     */
    public function transform();
}
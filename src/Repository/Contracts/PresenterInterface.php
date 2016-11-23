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
 * Interface PresenterInterface.
 */
interface PresenterInterface
{
    /**
     * Prepare data to present.
     *
     * @param $data
     *
     * @return mixed
     */
    public function present($data);
}

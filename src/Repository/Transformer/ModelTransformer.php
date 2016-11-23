<?php

/*
 * This file is part of Laravel Repository.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Repository\Transformer;

use BrianFaust\Repository\Contracts\Transformable;
use League\Fractal\TransformerAbstract;

/**
 * Class ModelTransformer.
 */
class ModelTransformer extends TransformerAbstract
{
    /**
     * @param Transformable $model
     *
     * @return array
     */
    public function transform(Transformable $model)
    {
        return $model->transform();
    }
}

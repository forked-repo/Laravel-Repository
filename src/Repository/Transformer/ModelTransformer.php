<?php

namespace BrianFaust\Repository\Transformer;

use League\Fractal\TransformerAbstract;
use BrianFaust\Repository\Contracts\Transformable;

/**
 * Class ModelTransformer.
 */
class ModelTransformer extends TransformerAbstract
{
    public function transform(Transformable $model)
    {
        return $model->transform();
    }
}

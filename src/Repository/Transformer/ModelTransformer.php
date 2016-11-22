<?php

namespace BrianFaust\Repository\Transformer;

use BrianFaust\Repository\Contracts\Transformable;
use League\Fractal\TransformerAbstract;

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

<?php

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

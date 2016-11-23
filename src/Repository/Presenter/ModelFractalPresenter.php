<?php

namespace BrianFaust\Repository\Presenter;

use BrianFaust\Repository\Transformer\ModelTransformer;
use Exception;

/**
 * Class ModelFractalPresenter.
 */
class ModelFractalPresenter extends FractalPresenter
{
    /**
     * Transformer.
     *
     * @throws Exception
     *
     * @return ModelTransformer
     */
    public function getTransformer()
    {
        return new ModelTransformer();
    }
}

<?php

/*
 * This file is part of Laravel Repository.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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

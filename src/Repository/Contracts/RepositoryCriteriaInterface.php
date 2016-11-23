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

use Illuminate\Support\Collection;

/**
 * Interface RepositoryCriteriaInterface.
 */
interface RepositoryCriteriaInterface
{
    /**
     * Push Criteria for filter the query.
     *
     * @param $criteria
     *
     * @return $this
     */
    public function pushCriteria($criteria);

    /**
     * Pop Criteria.
     *
     * @param $criteria
     *
     * @return $this
     */
    public function popCriteria($criteria);

    /**
     * Get Collection of Criteria.
     *
     * @return Collection
     */
    public function getCriteria();

    /**
     * Find data by Criteria.
     *
     * @param CriteriaInterface $criteria
     *
     * @return mixed
     */
    public function getByCriteria(CriteriaInterface $criteria);

    /**
     * Skip Criteria.
     *
     * @param bool $status
     *
     * @return $this
     */
    public function skipCriteria($status = true);

    /**
     * Reset all Criterias.
     *
     * @return $this
     */
    public function resetCriteria();
}

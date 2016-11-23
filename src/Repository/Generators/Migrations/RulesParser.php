<?php

/*
 * This file is part of Laravel Repository.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Repository\Generators\Migrations;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Class RulesParser.
 */
class RulesParser implements Arrayable
{
    /**
     * The set of rules.
     *
     * @var string
     */
    protected $rules;

    /**
     * Create new instance.
     *
     * @param string|null $rules
     */
    public function __construct($rules = null)
    {
        $this->rules = $rules;
    }

    /**
     * Convert string migration to array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->parse($this->rules);
    }

    /**
     * Parse a string to array of formatted rules.
     *
     * @param string $rules
     *
     * @return array
     */
    public function parse($rules)
    {
        $this->rules = $rules;
        $parsed = [];
        foreach ($this->getRules() as $rulesArray) {
            $column = $this->getColumn($rulesArray);
            $attributes = $this->getAttributes($column, $rulesArray);
            $parsed[$column] = $attributes;
        }

        return $parsed;
    }

    /**
     * Get array of rules.
     *
     * @return array
     */
    public function getRules()
    {
        if (is_null($this->rules)) {
            return [];
        }

        return explode(',', str_replace(' ', '', $this->rules));
    }

    /**
     * Get column name from rules.
     *
     * @param string $rules
     *
     * @return string
     */
    public function getColumn($rules)
    {
        return array_first(explode('=>', $rules), function ($key, $value) {
            return $value;
        });
    }

    /**
     * Get column attributes.
     *
     * @param string $column
     * @param string $rules
     *
     * @return array
     */
    public function getAttributes($column, $rules)
    {
        return str_replace($column.'=>', '', $rules);
    }
}

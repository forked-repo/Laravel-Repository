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
 * Class SchemaParser.
 */
class SchemaParser implements Arrayable
{
    /**
     * The array of custom attributes.
     *
     * @var array
     */
    protected $customAttributes = [
        'remember_token' => 'rememberToken()',
        'soft_delete'    => 'softDeletes()',
    ];
    /**
     * The migration schema.
     *
     * @var string
     */
    protected $schema;

    /**
     * Create new instance.
     *
     * @param string|null $schema
     */
    public function __construct($schema = null)
    {
        $this->schema = $schema;
    }

    /**
     * Render up migration fields.
     *
     * @return string
     */
    public function up()
    {
        return $this->render();
    }

    /**
     * Render the migration to formatted script.
     *
     * @return string
     */
    public function render()
    {
        $results = '';
        foreach ($this->toArray() as $column => $attributes) {
            $results .= $this->createField($column, $attributes);
        }

        return $results;
    }

    /**
     * Convert string migration to array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->parse($this->schema);
    }

    /**
     * Parse a string to array of formatted schema.
     *
     * @param string $schema
     *
     * @return array
     */
    public function parse($schema)
    {
        $this->schema = $schema;
        $parsed = [];
        foreach ($this->getSchemas() as $schemaArray) {
            $column = $this->getColumn($schemaArray);
            $attributes = $this->getAttributes($column, $schemaArray);
            $parsed[$column] = $attributes;
        }

        return $parsed;
    }

    /**
     * Get array of schema.
     *
     * @return array
     */
    public function getSchemas()
    {
        if (is_null($this->schema)) {
            return [];
        }

        return explode(',', str_replace(' ', '', $this->schema));
    }

    /**
     * Get column name from schema.
     *
     * @param string $schema
     *
     * @return string
     */
    public function getColumn($schema)
    {
        return array_first(explode(':', $schema), function ($key, $value) {
            return $value;
        });
    }

    /**
     * Get column attributes.
     *
     * @param string $column
     * @param string $schema
     *
     * @return array
     */
    public function getAttributes($column, $schema)
    {
        $fields = str_replace($column.':', '', $schema);

        return $this->hasCustomAttribute($column) ? $this->getCustomAttribute($column) : explode(':', $fields);
    }

    /**
     * Determinte whether the given column is exist in customAttributes array.
     *
     * @param string $column
     *
     * @return bool
     */
    public function hasCustomAttribute($column)
    {
        return array_key_exists($column, $this->customAttributes);
    }

    /**
     * Get custom attributes value.
     *
     * @param string $column
     *
     * @return array
     */
    public function getCustomAttribute($column)
    {
        return (array) $this->customAttributes[$column];
    }

    /**
     * Create field.
     *
     * @param string $column
     * @param array  $attributes
     *
     * @return string
     */
    public function createField($column, $attributes, $type = 'add')
    {
        $results = "\t\t\t".'$table';
        foreach ($attributes as $key => $field) {
            $results .= $this->{"{$type}Column"}($key, $field, $column);
        }

        return $results .= ';'.PHP_EOL;
    }

    /**
     * Render down migration fields.
     *
     * @return string
     */
    public function down()
    {
        $results = '';
        foreach ($this->toArray() as $column => $attributes) {
            $results .= $this->createField($column, $attributes, 'remove');
        }

        return $results;
    }

    /**
     * Format field to script.
     *
     * @param int    $key
     * @param string $field
     * @param string $column
     *
     * @return string
     */
    protected function addColumn($key, $field, $column)
    {
        if ($this->hasCustomAttribute($column)) {
            return '->'.$field;
        }
        if ($key == 0) {
            return '->'.$field."('".$column."')";
        }
        if (str_contains($field, '(')) {
            return '->'.$field;
        }

        return '->'.$field.'()';
    }

    /**
     * Format field to script.
     *
     * @param int    $key
     * @param string $field
     * @param string $column
     *
     * @return string
     */
    protected function removeColumn($key, $field, $column)
    {
        if ($this->hasCustomAttribute($column)) {
            return '->'.$field;
        }

        return '->dropColumn('."'".$column."')";
    }
}
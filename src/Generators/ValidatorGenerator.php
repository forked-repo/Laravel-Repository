<?php

/*
 * This file is part of Laravel Repository.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Repository\Generators;

use BrianFaust\Repository\Generators\Migrations\RulesParser;
use BrianFaust\Repository\Generators\Migrations\SchemaParser;

/**
 * Class ValidatorGenerator.
 */
class ValidatorGenerator extends Generator
{
    /**
     * Get stub name.
     *
     * @var string
     */
    protected $stub = 'validator/validator';

    /**
     * Get root namespace.
     *
     * @return string
     */
    public function getRootNamespace()
    {
        return parent::getRootNamespace().parent::getConfigGeneratorClassPath($this->getPathConfigNode());
    }

    /**
     * Get generator path config node.
     *
     * @return string
     */
    public function getPathConfigNode()
    {
        return 'validators';
    }

    /**
     * Get destination path for generated file.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->getBasePath().'/'.parent::getConfigGeneratorClassPath($this->getPathConfigNode(), true).'/'.$this->getName().'Validator.php';
    }

    /**
     * Get base path of destination file.
     *
     * @return string
     */
    public function getBasePath()
    {
        return config('repository.generator.basePath', app()->path());
    }

    /**
     * Get array replacements.
     *
     * @return array
     */
    public function getReplacements()
    {
        return array_merge(parent::getReplacements(), [
            'rules' => $this->getRules(),
        ]);
    }

    /**
     * Get the rules.
     *
     * @return string
     */
    public function getRules()
    {
        if (!$this->rules) {
            return '[]';
        }
        $results = '['.PHP_EOL;

        foreach ($this->getSchemaParser()->toArray() as $column => $value) {
            $results .= "\t\t'{$column}'\t=>'\t{$value}',".PHP_EOL;
        }

        return $results."\t".']';
    }

    /**
     * Get schema parser.
     *
     * @return SchemaParser
     */
    public function getSchemaParser()
    {
        return new RulesParser($this->rules);
    }
}

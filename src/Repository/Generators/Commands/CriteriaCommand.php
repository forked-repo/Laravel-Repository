<?php

namespace BrianFaust\Repository\Generators\Commands;

use BrianFaust\Repository\Generators\CriteriaGenerator;
use BrianFaust\Repository\Generators\FileAlreadyExistsException;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class CriteriaCommand extends Command
{
    /**
     * The name of command.
     *
     * @var string
     */
    protected $name = 'make:criteria';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Create a new criteria.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Criteria';

    /**
     * Execute the command.
     */
    public function fire()
    {
        try {
            (new CriteriaGenerator([
                'name'  => $this->argument('name'),
                'force' => $this->option('force'),
            ]))->run();

            $this->info('Criteria created successfully.');
        } catch (FileAlreadyExistsException $ex) {
            $this->error($this->type.' already exists!');

            return false;
        }
    }

    /**
     * The array of command arguments.
     *
     * @return array
     */
    public function getArguments()
    {
        return [
            [
                'name',
                InputArgument::REQUIRED,
                'The name of class being generated.',
                null,
            ],
        ];
    }

    /**
     * The array of command options.
     *
     * @return array
     */
    public function getOptions()
    {
        return [
            [
                'force',
                'f',
                InputOption::VALUE_NONE,
                'Force the creation if file already exists.',
                null,
            ],
        ];
    }
}
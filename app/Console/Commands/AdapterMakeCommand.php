<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class AdapterMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:adapter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new custom adapter class.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Adapter';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/service.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Services\Adapters';
    }
}

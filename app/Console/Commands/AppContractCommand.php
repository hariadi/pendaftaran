<?php

namespace App\Console\Commands;

class AppContractCommand extends AppGeneratorCommand
{
    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Contract';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:contract {name : The model class name.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new contract class';

    /**
     * The methods available.
     *
     * @var array
     */
    protected function getMethods()
    {
        return ['all', 'paginated', 'find', 'create', 'update', 'delete'];
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/contract.stub';
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        parent::handle();
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        return $this->argument('name');
    }

    /**
     * Get the intended name for class.
     *
     * @return string
     */
    protected function getClassName()
    {
        return basename($this->getNameInput()) . 'Contract';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Repositories' .'\\' . $this->argument('name');
    }
}

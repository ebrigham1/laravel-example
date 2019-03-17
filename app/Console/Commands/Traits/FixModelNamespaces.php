<?php

namespace App\Console\Commands\Traits;

use Illuminate\Support\Str;

trait FixModelNamespaces
{
    /**
     * Execute the console command.
     *
     * @return bool|null
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        if ($this->hasOption('model')) {
            $this->input->setOption('model', $this->qualifyModelClass($this->option('model')));
        }
        parent::handle();
    }

    /**
     * Parse the model class name and format according to the root model namespace.
     *
     * @param string $name
     * @return string
     */
    protected function qualifyModelClass($name)
    {
        $name = ltrim($name, '\\/');
        $rootNamespace = $this->rootNamespace();
        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }
        $name = str_replace('/', '\\', $name);
        return $this->qualifyModelClass(
            $this->getDefaultModelNamespace(trim($rootNamespace, '\\')) . '\\' . $name
        );
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultModelNamespace($rootNamespace)
    {
        return $rootNamespace . '\Models';
    }
}

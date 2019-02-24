<?php

namespace App\Console\Commands;

use App\Console\Commands\Traits\FixModelNamespaces;
use Illuminate\Database\Console\Factories\FactoryMakeCommand as IlluminateFactoryMakeCommand;

class FactoryMakeCommand extends IlluminateFactoryMakeCommand
{
    use FixModelNamespaces;
}

<?php

declare(strict_types=1);

namespace Infection\BenchmarkCodeGenerator\Console;

use Infection\BenchmarkCodeGenerator\Console\Command\GenerateCommand;
use Symfony\Component\Console\Application as SymfonyApplication;

final class Application extends SymfonyApplication
{
    public function __construct()
    {
        parent::__construct('InfectionBenchmarkCodeGenerator', 'dev');

        $this->add(GenerateCommand::create());
    }
}

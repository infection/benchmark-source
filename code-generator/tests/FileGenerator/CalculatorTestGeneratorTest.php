<?php

namespace Infection\BenchmarkCodeGenerator\Test\FileGenerator;

use Infection\BenchmarkCodeGenerator\FileGenerator\CalculatorTestGenerator;
use Infection\BenchmarkCodeGenerator\FileGenerator\FileGenerator;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(CalculatorTestGenerator::class)]
final class CalculatorTestGeneratorTest extends BasicGeneratorTestCase
{
    protected function createGenerator(): FileGenerator
    {
        return new CalculatorTestGenerator();
    }
}

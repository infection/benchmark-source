<?php

namespace Infection\BenchmarkCodeGenerator\Test\FileGenerator;

use Infection\BenchmarkCodeGenerator\FileGenerator\CalculatorGenerator;
use Infection\BenchmarkCodeGenerator\FileGenerator\FileGenerator;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(CalculatorGenerator::class)]
final class CalculatorGeneratorTest extends BasicGeneratorTestCase
{
    protected function createGenerator(): FileGenerator
    {
        return new CalculatorGenerator();
    }
}

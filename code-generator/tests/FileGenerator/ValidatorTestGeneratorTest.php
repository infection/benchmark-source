<?php

namespace Infection\BenchmarkCodeGenerator\Test\FileGenerator;

use Infection\BenchmarkCodeGenerator\FileGenerator\FileGenerator;
use Infection\BenchmarkCodeGenerator\FileGenerator\ValidatorTestGenerator;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ValidatorTestGenerator::class)]
final class ValidatorTestGeneratorTest extends BasicGeneratorTestCase
{
    protected function createGenerator(): FileGenerator
    {
        return new ValidatorTestGenerator();
    }
}

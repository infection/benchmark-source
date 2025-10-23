<?php

namespace Infection\BenchmarkCodeGenerator\Test\FileGenerator;

use Infection\BenchmarkCodeGenerator\FileGenerator\FileGenerator;
use Infection\BenchmarkCodeGenerator\FileGenerator\ValidatorGenerator;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ValidatorGenerator::class)]
final class ValidatorGeneratorTest extends BasicGeneratorTestCase
{
    protected function createGenerator(): FileGenerator
    {
        return new ValidatorGenerator();
    }
}

<?php

namespace Infection\BenchmarkCodeGenerator\Test\FileGenerator;

use Infection\BenchmarkCodeGenerator\FileGenerator\FileGenerator;
use Infection\BenchmarkCodeGenerator\FileGenerator\StringProcessorTestGenerator;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(StringProcessorTestGenerator::class)]
final class StringProcessorTestGeneratorTest extends BasicGeneratorTestCase
{
    protected function createGenerator(): FileGenerator
    {
        return new StringProcessorTestGenerator();
    }
}

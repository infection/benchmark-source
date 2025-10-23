<?php

namespace Infection\BenchmarkCodeGenerator\Test\FileGenerator;

use Infection\BenchmarkCodeGenerator\FileGenerator\FileGenerator;
use Infection\BenchmarkCodeGenerator\FileGenerator\StringProcessorGenerator;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(StringProcessorGenerator::class)]
final class StringProcessorGeneratorTest extends BasicGeneratorTestCase
{
    protected function createGenerator(): FileGenerator
    {
        return new StringProcessorGenerator();
    }
}

<?php

namespace Infection\BenchmarkCodeGenerator\Test\FileGenerator;

use Infection\BenchmarkCodeGenerator\FileGenerator\DataTransformerGenerator;
use Infection\BenchmarkCodeGenerator\FileGenerator\FileGenerator;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(DataTransformerGenerator::class)]
final class DataTransformerGeneratorTest extends BasicGeneratorTestCase
{
    protected function createGenerator(): FileGenerator
    {
        return new DataTransformerGenerator();
    }
}

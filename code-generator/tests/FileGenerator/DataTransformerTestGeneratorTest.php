<?php

namespace Infection\BenchmarkCodeGenerator\Test\FileGenerator;

use Infection\BenchmarkCodeGenerator\FileGenerator\DataTransformerTestGenerator;
use Infection\BenchmarkCodeGenerator\FileGenerator\FileGenerator;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(DataTransformerTestGenerator::class)]
final class DataTransformerTestGeneratorTest extends BasicGeneratorTestCase
{
    protected function createGenerator(): FileGenerator
    {
        return new DataTransformerTestGenerator();
    }
}

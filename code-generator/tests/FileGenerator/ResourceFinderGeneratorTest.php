<?php

namespace Infection\BenchmarkCodeGenerator\Test\FileGenerator;

use Infection\BenchmarkCodeGenerator\FileGenerator\FileGenerator;
use Infection\BenchmarkCodeGenerator\FileGenerator\ResourceFinderGenerator;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ResourceFinderGenerator::class)]
final class ResourceFinderGeneratorTest extends BasicGeneratorTestCase
{
    protected function createGenerator(): FileGenerator
    {
        return new ResourceFinderGenerator();
    }
}

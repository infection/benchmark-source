<?php

namespace Infection\BenchmarkCodeGenerator\Test\FileGenerator;

use Infection\BenchmarkCodeGenerator\FileGenerator\FileGenerator;
use Infection\BenchmarkCodeGenerator\FileGenerator\ResourceFinderTestGenerator;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ResourceFinderTestGenerator::class)]
final class ResourceFinderTestGeneratorTest extends BasicGeneratorTestCase
{
    protected function createGenerator(): FileGenerator
    {
        return new ResourceFinderTestGenerator();
    }
}

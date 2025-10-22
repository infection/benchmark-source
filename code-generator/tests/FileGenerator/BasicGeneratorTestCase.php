<?php

namespace Infection\BenchmarkCodeGenerator\Test\FileGenerator;

use Infection\BenchmarkCodeGenerator\FileGenerator\FileGenerator;
use PHPUnit\Framework\TestCase;

abstract class BasicGeneratorTestCase extends TestCase
{
    private FileGenerator $generator;

    protected function setUp(): void
    {
        $this->generator = $this->createGenerator();
    }

    public function test_it_generates_a_file_using_the_id(): void
    {
        $generatedFile = $this->generator->generate(10);

        self::assertStringContainsString('10', $generatedFile->relativePath);
        // Check the generated path is a PHP file
        self::assertStringEndsWith('.php', $generatedFile->relativePath);

        // Check the content is a PHP file
        self::assertStringStartsWith('<?php', $generatedFile->content);
        // Check the generated content does not contain any placeholder value.
        self::assertStringNotContainsString('__ID__', $generatedFile->content);
    }

    abstract protected function createGenerator(): FileGenerator;
}

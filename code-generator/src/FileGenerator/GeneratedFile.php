<?php

declare(strict_types=1);

namespace Infection\BenchmarkCodeGenerator\FileGenerator;

final readonly class GeneratedFile
{
    public function __construct(
        public string $relativePath,
        public string $content,
    ) {}
}

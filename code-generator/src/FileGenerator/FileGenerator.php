<?php

namespace Infection\BenchmarkCodeGenerator\FileGenerator;

interface FileGenerator
{
    public function generate(string $id): GeneratedFile;
}

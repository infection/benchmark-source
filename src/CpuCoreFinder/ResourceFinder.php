<?php

declare(strict_types=1);

namespace Infection\BenchmarkSource\CpuCoreFinder;

interface ResourceFinder
{
    public function find(): mixed;

    public function diagnose(): string;

    public function toString(): string;
}

<?php

declare(strict_types=1);

namespace Infection\BenchmarkCodeGenerator;

use function str_pad;
use function strlen;
use const STR_PAD_LEFT;

final readonly class IdGenerator
{
    /**
     * @param positive-int $padLength
     */
    private function __construct(
        private int $padLength,
    ) {
    }

    /**
     * @param positive-int $maxFileCount
     */
    public static function create(int $maxFileCount): self
    {
        return new self(
            strlen((string) $maxFileCount),
        );
    }

    public function generate(int $index): string
    {
        return str_pad(
            (string) $index,
            $this->padLength,
            '0',
            STR_PAD_LEFT,
        );
    }
}

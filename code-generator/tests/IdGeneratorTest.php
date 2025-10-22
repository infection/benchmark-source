<?php

namespace Infection\BenchmarkCodeGenerator\Test;

use Infection\BenchmarkCodeGenerator\IdGenerator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use function array_keys;

#[CoversClass(IdGenerator::class)]
final class IdGeneratorTest extends TestCase
{
    /**
     * @param positive-int $maxFileCount
     * @param array<int, string> $expected
     */
    #[DataProvider('indexProvider')]
    public function test_it_can_generate_an_id(
        int $maxFileCount,
        array $expected,
    ): void
    {
        $generator = IdGenerator::create($maxFileCount);

        $actual = [];

        foreach (array_keys($expected) as $index) {
            $actual[$index] = $generator->generate($index);
        }

        self::assertSame($expected, $actual);
    }

    public static function indexProvider(): iterable
    {
        yield [
            7,
            [
                0 => '0',
                1 => '1',
                3 => '3',
            ],
        ];

        yield [
            17,
            [
                0 => '00',
                7 => '07',
                13 => '13',
            ],
        ];
    }
}

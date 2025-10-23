<?php

declare(strict_types=1);

namespace Infection\BenchmarkCodeGenerator\FileGenerator;

use function array_map;

final readonly class GeneratorRegistry
{
    /**
     * @var list<FileGenerator>
     */
    private array $generators;

    public function __construct(FileGenerator ...$generators)
    {
        $this->generators = $generators;
    }

    public static function create(): self
    {
        return new self(
            new ResourceFinderGenerator(),
            new ResourceFinderTestGenerator(),
            new StringProcessorGenerator(),
            new StringProcessorTestGenerator(),
            new CalculatorGenerator(),
            new CalculatorTestGenerator(),
            new DataTransformerGenerator(),
            new DataTransformerTestGenerator(),
            new ValidatorGenerator(),
            new ValidatorTestGenerator(),
        );
    }

    /**
     * @return list<GeneratedFile>
     */
    public function generate(string $id): array
    {
        return array_map(
            static fn (FileGenerator $generator) => $generator->generate($id),
            $this->generators,
        );
    }
}
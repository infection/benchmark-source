<?php

declare(strict_types=1);

namespace Infection\BenchmarkCodeGenerator\Console\Command;

use Infection\BenchmarkCodeGenerator\FileGenerator\GeneratorRegistry;
use Infection\BenchmarkCodeGenerator\IdGenerator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LazyCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;
use Webmozart\Assert\Assert;
use function sprintf;

final class GenerateCommand extends Command
{
    private const FILE_COUNT_ARGUMENT = 'fileCount';
    private const PROJECT_ROOT_ARGUMENT = 'projectRoot';
    private const DRY_RUN_OPTION = 'dry-run';

    private const DEFAULT_FILE_COUNT = 10;
    private const DEFAULT_PROJECT_ROOT = __DIR__.'/../../../..';

    public function __construct(
        private readonly Filesystem $filesystem,
        private readonly GeneratorRegistry $generatorRegistry,
    ) {
        parent::__construct();
    }

    public static function create(): LazyCommand
    {
        return new LazyCommand(
            name: 'generate',
            description: 'Generate the source code and tests.',
            aliases: [],
            isHidden: false,
            commandFactory: static fn () => new self(
                filesystem: new Filesystem(),
                generatorRegistry: GeneratorRegistry::create(),
            ),
            isEnabled: true,
        );
    }

    protected function configure(): void
    {
        $this->addArgument(
            self::FILE_COUNT_ARGUMENT,
            InputArgument::OPTIONAL,
            'Number of source files to generate.',
            self::DEFAULT_FILE_COUNT,
        );
        $this->addArgument(
            self::PROJECT_ROOT_ARGUMENT,
            InputArgument::OPTIONAL,
            'Target directory to use as a root for the generated files.',
            Path::canonicalize(self::DEFAULT_PROJECT_ROOT),
        );
        $this->addOption(
            self::DRY_RUN_OPTION,
            null,
            InputOption::VALUE_NONE,
            'Will not execute Filesystem operation.',
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $fileCount = self::getFileCount($input);
        $projectRoot = self::getProjectRoot($input);
        $isDryRun = self::isDryRun($input);
        $errorOutput = self::getErrorOutput($output);

        $progressBar = self::createProgressBar($errorOutput, $fileCount);
        $idGenerator = IdGenerator::create($fileCount);

        $generatedFileCount = 0;

        for ($index = 0; $index < $fileCount; $index++) {
            $generatedFileCount += $this->generateFiles(
                $idGenerator->generate($index),
                $projectRoot,
                $output,
                $isDryRun,
            );

            $progressBar?->advance();
        }

        $progressBar?->finish();
        if (null !== $progressBar) {
            $errorOutput->writeln('');
        }

        $output->writeln(
            sprintf(
                'Generated <info>%d</info> file(s).',
                $generatedFileCount,
            ),
        );

        return self::SUCCESS;
    }

    private static function getFileCount(InputInterface $input): int
    {
        $value = $input->getArgument(self::FILE_COUNT_ARGUMENT);
        Assert::integerish(
            $value,
            sprintf(
                'Expected the argument "%s" to be a positive integer. Got "%s" instead.',
                self::FILE_COUNT_ARGUMENT,
                $value,
            ),
        );

        $intValue = (int) $value;

        Assert::positiveInteger(
            $intValue,
            sprintf(
                'Expected the argument "%s" to be a positive integer. Got "%%s" instead.',
                self::FILE_COUNT_ARGUMENT,
            ),
        );

        return $intValue;
    }

    private static function getProjectRoot(InputInterface $input): string
    {
        return Path::canonicalize($input->getArgument(self::PROJECT_ROOT_ARGUMENT));
    }

    private static function isDryRun(InputInterface $input): bool
    {
        return $input->getOption(self::DRY_RUN_OPTION);
    }

    private static function getErrorOutput(OutputInterface $output): OutputInterface
    {
        return $output instanceof ConsoleOutputInterface
            ? $output->getErrorOutput()
            : $output;
    }

    /**
     * @param positive-int $fileCount
     */
    private static function createProgressBar(
        OutputInterface $output,
        int $fileCount,
    ): ?ProgressBar
    {
        if ($output->isVerbose()) {
            return null;
        }

        $progressBar = new ProgressBar($output, $fileCount);
        $progressBar->setFormat(ProgressBar::FORMAT_DEBUG);

        return $progressBar;
    }

    /**
     * @return positive-int|0
     */
    private function generateFiles(
        string $id,
        string $projectRoot,
        OutputInterface $output,
        bool $isDryRun,
    ): int
    {
        $count = 0;

        foreach ($this->generatorRegistry->generate($id) as $generatedFile) {
            $path = Path::join(
                $projectRoot,
                $generatedFile->relativePath,
            );

            if (!$isDryRun) {
                $this->filesystem->dumpFile($path, $generatedFile->content);
            }

            $output->writeln(
                sprintf(
                    'Generated <comment>%s</comment>>.',
                    $path,
                ),
                OutputInterface::VERBOSITY_VERBOSE,
            );

            ++$count;
        }

        return $count;
    }
}
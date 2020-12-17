<?php

declare(strict_types=1);

namespace Mentor\Command;

use Mentor\Contract\AdviceInterface;
use Mentor\ValueObject\Option;
use Nette\Utils\Strings;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symplify\PackageBuilder\Console\ShellCode;

final class AdviseCommand extends AbstractCommand
{
    /**
     * @var SymfonyStyle
     */
    private $symfonyStyle;

    /**
     * @var AdviceInterface[]
     */
    private $advices = [];

    /**
     * @param AdviceInterface[] $advices
     */
    public function __construct(SymfonyStyle $symfonyStyle, array $advices)
    {
        $this->symfonyStyle = $symfonyStyle;
        $this->advices = $advices;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Aks for 1 piece of advice for you project');
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $fix = (bool) $input->getOption(Option::FIX);
        foreach ($this->advices as $advice) {
            if (! $advice->isRelevant()) {
                continue;
            }

            $this->symfonyStyle->title($advice->getName());
            $this->symfonyStyle->writeln('<fg=green>Why?</>');
            $this->symfonyStyle->writeln('<fg=green>----</>' . PHP_EOL);
            $this->symfonyStyle->writeln($advice->getWhy() . PHP_EOL);

            if ($fix === true) {
                $advice->getJobDone();
                $this->symfonyStyle->success('Fix it');
            }
        }

        return ShellCode::SUCCESS;
    }
}

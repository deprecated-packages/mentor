<?php

declare(strict_types=1);

namespace Mentor\Command;

use Mentor\ValueObject\Option;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;

abstract class AbstractCommand extends Command
{
    protected function configure()
    {
        $this->addOption(Option::FIX, null, InputArgument::OPTIONAL, 'Apply the advice');
        $this->setDescription('Aks for 1 piece of advice for you project');
    }
}

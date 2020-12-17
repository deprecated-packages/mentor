<?php

declare(strict_types=1);

namespace Mentor\Advice;

use Mentor\Contract\AdviceInterface;

final class GitIgnoreAdvice implements AdviceInterface
{
    public function getName(): string
    {
        return 'Vendor in .gitignore';
    }

    public function isRelevant(): bool
    {
        return ! file_exists(getcwd() . '/.gitignore');
    }

    public function getWhy(): string
    {
        return 'The ".gitignore" config file helps you keep local files really local, e.g. "/vendor" should be only local';
    }

    public function getJobDone(): void
    {
        // ...
    }
}

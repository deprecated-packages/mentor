<?php

declare(strict_types=1);

namespace Mentor\Advice;

use Mentor\Contract\AdviceInterface;
use Symfony\Component\Process\Process;
use Symplify\SmartFileSystem\SmartFileSystem;

final class GitIgnoreAdvice implements AdviceInterface
{
    /**
     * @var SmartFileSystem
     */
    private $smartFileSystem;

    /**
     * @var string
     */
    private $filePath;

    /**
     * @var string
     */
    private const GITIGNORE_TEMPLATE_FILE_PATH =  __DIR__ . '/../../templates/gitignore/.gitignore';

    public function __construct(SmartFileSystem $smartFileSystem)
    {
        $this->filePath = getcwd() . '/.gitignore';
        $this->smartFileSystem = $smartFileSystem;
    }

    public function getName(): string
    {
        return '/vendor in .gitignore';
    }

    public function isRelevant(): bool
    {
        return ! file_exists($this->filePath);
    }

    public function getWhy(): string
    {
        // @todo find some Stackoverflow link
        return 'The ".gitignore" config file helps you keep local files really local, e.g. "/vendor" should be only local'
            . PHP_EOL
            . 'See https://getcomposer.org/doc/faqs/should-i-commit-the-dependencies-in-my-vendor-directory.md#should-i-commit-the-dependencies-in-my-vendor-directory'
            . PHP_EOL
            . 'See https://stackoverflow.com/a/7927283/1348344';
    }

    public function getJobDone(): void
    {
        $this->addGitignore();

        // remove vendor from remote
        $process = Process::fromShellCommandline('git rm -r --cached vendor');
        $process->run();

        $process = Process::fromShellCommandline("git commit -m 'Remove the now ignored vendor director'");
        $process->run();
    }

    private function addGitignore(): void
    {
        $this->smartFileSystem->copy(self::GITIGNORE_TEMPLATE_FILE_PATH, $this->filePath);
    }
}

<?php

declare(strict_types=1);

namespace Mentor\Advice;

use Mentor\Contract\AdviceInterface;
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
        return 'The ".gitignore" config file helps you keep local files really local, e.g. "/vendor" should be only local';
    }

    public function getJobDone(): void
    {
        // @todo also remove /vendor
        $this->smartFileSystem->copy(self::GITIGNORE_TEMPLATE_FILE_PATH, $this->filePath);
    }
}

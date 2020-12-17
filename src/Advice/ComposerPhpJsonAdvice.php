<?php

declare(strict_types=1);

namespace Mentor\Advice;

use Mentor\Contract\AdviceInterface;
use Symplify\ComposerJsonManipulator\ComposerJsonFactory;
use Symplify\SmartFileSystem\SmartFileSystem;

final class ComposerPhpJsonAdvice implements AdviceInterface
{
    /**
     * @var ComposerJsonFactory
     */
    private $composerJsonFactory;

    /**
     * @var string
     */
    private $composerJsonFilePath;

    public function __construct(ComposerJsonFactory $composerJsonFactory)
    {
        $this->composerJsonFilePath = getcwd() . '/composer.json';
        $this->composerJsonFactory = $composerJsonFactory;
    }

    public function getName(): string
    {
        return 'Make PHP version';
    }

    public function isRelevant(): bool
    {
        dump($this->composerJsonFilePath);
        dump('...');
        die;
    }

    public function getWhy(): string
    {
        return 'Make sure `composer.json` has PHP version';
    }

    public function getJobDone(): void
    {
        // update composer.json
        dump(__DIR__);
        dump('...');
        die;
    }
}

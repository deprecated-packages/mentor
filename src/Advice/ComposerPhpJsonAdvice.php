<?php

declare(strict_types=1);

namespace Mentor\Advice;

use Mentor\Contract\AdviceInterface;
use Symplify\ComposerJsonManipulator\ComposerJsonFactory;
use Symplify\SmartFileSystem\SmartFileSystem;

// @todo apply

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

    /**
     * @var SmartFileSystem
     */
    private $smartFileSystem;

    public function __construct(ComposerJsonFactory $composerJsonFactory, SmartFileSystem $smartFileSystem)
    {
        $this->composerJsonFilePath = getcwd() . '/composer.json';
        $this->composerJsonFactory = $composerJsonFactory;
        $this->smartFileSystem = $smartFileSystem;
    }

    public function getName(): string
    {
        return 'Make PHP version explicit in composer.json';
    }

    public function isRelevant(): bool
    {
        if (! file_exists($this->composerJsonFilePath)) {
            return false;
        }

        $composerJson = $this->composerJsonFactory->createFromFilePath($this->composerJsonFilePath);
        return $composerJson->getRequirePhpVersion() === null;
    }

    public function getWhy(): string
    {
        return 'Make sure `composer.json` has PHP version';
    }

    public function getJobDone(): void
    {
        $composerJson = $this->composerJsonFactory->createFromFilePath($this->composerJsonFilePath);

        // @todo resolve - what would human do
        // @guess from platform?
        // @guess from PHP parser and try features and exceptions?
        // @detect from minimum composer packages version?

        // @todo via config
        $phpParserFactory = new PhpParserFactory();
        $parser = $phpParserFactory->create();

        dump($composerJson->getRequirePhpVersion());
        die;
    }
}

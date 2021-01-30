<?php

declare(strict_types=1);

namespace Mentor\Advice;

use Mentor\Contract\AdviceInterface;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitorAbstract;
use PhpParser\ParserFactory;
use Symplify\ComposerJsonManipulator\ComposerJsonFactory;
use Symplify\SmartFileSystem\Finder\SmartFinder;
use Symplify\SmartFileSystem\SmartFileSystem;

// @todo add composer.json phpunit + dir tests + phpunit.xml :)

final class InitTestsAdvice implements AdviceInterface
{
    /**
     * @var string
     */
    private $composerJsonFilePath;

    /**
     * @var SmartFileSystem
     */
    private $smartFileSystem;

    public function __construct(
        ComposerJsonFactory $composerJsonFactory,
        SmartFileSystem $smartFileSystem,
        SmartFinder $smartFinder
    )
    {
        $this->composerJsonFilePath = getcwd() . '/composer.json';
        $this->composerJsonFactory = $composerJsonFactory;
        $this->smartFileSystem = $smartFileSystem;
        $this->smartFinder = $smartFinder;
    }

    public function getName(): string
    {
        return 'Make PHP version explicit in composer.json';
    }

    public function isRelevant(): bool
    {
        // dir eixsts?
        return true;
    }

    public function getWhy(): string
    {
        return 'Make sure `composer.json` has PHP version';
    }

    public function getJobDone(): void
    {
        dump('____');
        die;
    }
}

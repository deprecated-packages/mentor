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
    /**
     * @var SmartFinder
     */
    private $smartFinder;

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
        $parserFactory = new ParserFactory();
        $parser = $parserFactory->create(ParserFactory::PREFER_PHP7);

        $fileInfos = $this->smartFinder->find([__DIR__ . '/../../src'], '*.php');

        $nodeTraverser = new NodeTraverser();
        $nodeTraverser->addVisitor(class() extends NodeVisitorAbstract() {

       });
        foreach ($fileInfos as $fileInfo) {
            $nodes = $parser->parse($fileInfo->getContents());
            die;
        }

        // traverse with node traverserss and get the right version


        // parse code untill the PHP version is done right

        dump($composerJson->getRequirePhpVersion());
        die;
    }
}

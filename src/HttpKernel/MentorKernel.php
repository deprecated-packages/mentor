<?php

declare(strict_types=1);

namespace Mentor\HttpKernel;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symplify\ConsolePackageBuilder\DependencyInjection\CompilerPass\NamelessConsoleCommandCompilerPass;
use Symplify\SymplifyKernel\HttpKernel\AbstractSymplifyKernel;

final class MentorKernel extends AbstractSymplifyKernel implements CompilerPassInterface
{
    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        $loader->load(__DIR__ . '/../../config/config.php');
    }

    public function process(ContainerBuilder $containerBuilder)
    {
        $containerBuilder->addCompilerPass(new NamelessConsoleCommandCompilerPass());
    }
}

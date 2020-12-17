<?php

declare(strict_types=1);

namespace Mentor\HttpKernel;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symplify\SymplifyKernel\HttpKernel\AbstractSymplifyKernel;

final class MentorKernel extends AbstractSymplifyKernel implements CompilerPassInterface
{
    public function process(ContainerBuilder $containerBuilder)
    {
        $containerBuilder->addCompilerPass(new Name);
    }
}

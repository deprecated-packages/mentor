<?php

require __DIR__ . '/../vendor/autoload.php';

use Symplify\SymplifyKernel\HttpKernel\AbstractSymplifyKernel;
use Symplify\SymplifyKernel\ValueObject\KernelBootAndApplicationRun;

$possibleAutoloadPaths = [
    // after split package
    __DIR__ . '/../vendor/autoload.php',
    // dependency
    __DIR__ . '/../../../autoload.php',
    // monorepo
    __DIR__ . '/../../../vendor/autoload.php',
];

foreach ($possibleAutoloadPaths as $possibleAutoloadPath) {
    if (file_exists($possibleAutoloadPath)) {
        require_once $possibleAutoloadPath;

        break;
    }
}


$kernelBootAndApplicationRun = new KernelBootAndApplicationRun(AbstractSymplifyKernel::class);
$kernelBootAndApplicationRun->run();

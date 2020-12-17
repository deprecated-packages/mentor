<?php

require __DIR__ . '/../vendor/autoload.php';

use Mentor\HttpKernel\MentorKernel;
use Symplify\SymplifyKernel\ValueObject\KernelBootAndApplicationRun;

$possibleAutoloadPaths = [
    // dev package
    __DIR__ . '/../vendor/autoload.php',
    // dependency
    __DIR__ . '/../../../autoload.php',
];

foreach ($possibleAutoloadPaths as $possibleAutoloadPath) {
    if (file_exists($possibleAutoloadPath)) {
        require_once $possibleAutoloadPath;
        break;
    }
}


$kernelBootAndApplicationRun = new KernelBootAndApplicationRun(MentorKernel::class);
$kernelBootAndApplicationRun->run();

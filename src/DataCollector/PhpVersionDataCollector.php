<?php

declare(strict_types=1);

namespace Mentor\DataCollector;

final class PhpVersionDataCollector
{
    public function collect(string $version)
    {
        dump($version);
        die;
    }
}

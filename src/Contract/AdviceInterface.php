<?php

declare(strict_types=1);

namespace Mentor\Contract;

interface AdviceInterface
{
    public function getName(): string;

    public function isRelevant(): bool;

    public function getWhy(): string;

    public function getJobDone(): void;
}

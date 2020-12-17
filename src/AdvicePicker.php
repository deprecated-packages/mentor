<?php

declare(strict_types=1);

namespace Mentor;

use Mentor\Contract\AdviceInterface;

final class AdvicePicker
{
    /**
     * @var AdviceInterface[]
     */
    private $advices = [];

    /**
     * @param AdviceInterface[] $advices
     */
    public function __construct(array $advices)
    {
        $this->advices = $advices;
    }

    public function pick(): ?AdviceInterface
    {
        $relevantAdvices = [];

        foreach ($this->advices as $advice) {
            if (! $advice->isRelevant()) {
                continue;
            }

            $relevantAdvices[] = $advice;
        }

        if ($relevantAdvices === []) {
            return null;
        }

        return array_rand($relevantAdvices);
    }
}

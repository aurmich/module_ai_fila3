<?php

declare(strict_types=1);

namespace Modules\AI\Contracts;

interface SentimentAnalyzer
{
    public function analyze(string $text): array;
}

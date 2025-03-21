<?php

declare(strict_types=1);

namespace Modules\AI\Actions;

use Modules\AI\Contracts\SentimentAnalyzer;
use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;
use function Safe\error_log;

class BasicSentimentAnalyzer implements SentimentAnalyzer
{
    public function analyze(string $text): array
    {
        // Basic sentiment analysis using simple text patterns
        $positiveWords = ['good', 'great', 'excellent', 'positive', 'happy'];
        $negativeWords = ['bad', 'poor', 'terrible', 'negative', 'unhappy'];

        $positiveCount = 0;
        $negativeCount = 0;

        foreach ($positiveWords as $word) {
            if (false !== stripos($text, $word)) {
                ++$positiveCount;
            }
        }

        foreach ($negativeWords as $word) {
            if (false !== stripos($text, $word)) {
                ++$negativeCount;
            }
        }

        $score = ($positiveCount - $negativeCount) / max(1, $positiveCount + $negativeCount);

        return [
            'label' => $score >= 0 ? 'POSITIVE' : 'NEGATIVE',
            'score' => abs($score),
            'warning' => 'Using basic sentiment analysis - install transformers for better accuracy',
        ];
    }
}

/**
 * Sentiment analysis action using either transformers or basic implementation.
 *
 * The transformers implementation requires the codewithkyrian/transformers package.
 * If not available, it falls back to a basic text pattern matching implementation.
 *
 * To enable the full functionality, install the package:
 *
 * ```bash
 * composer require codewithkyrian/transformers
 * ```
 *
 * Note: You may see IDE errors about undefined types/functions until the package
 * is installed. These can be safely ignored as the code will automatically fall
 * back to basic text analysis if the package is not available.
 */
class SentimentAction
{
    use QueueableAction;

    private SentimentAnalyzer $analyzer;

    public function __construct()
    {
        $this->analyzer = class_exists('Codewithkyrian\Transformers\Transformers')
            ? new TransformersSentimentAnalyzer()
            : new BasicSentimentAnalyzer();
    }

    public function execute(string $prompt): array
    {
        try {
            return $this->analyzer->analyze($prompt);
        } catch (\Exception $e) {
            error_log('Sentiment analysis error: '.$e->getMessage());

            return [
                'error' => $e->getMessage(),
                'status' => 'error',
            ];
        }
    }
}

class TransformersSentimentAnalyzer implements SentimentAnalyzer
{
    private string $cacheDir = './../cache/models';

    public function analyze(string $text): array
    {
        try {
            if (! class_exists('Codewithkyrian\Transformers\Transformers')) {
                throw new \Exception('Transformers library not installed');
            }

            /**
             * @var class-string<\Codewithkyrian\Transformers\Transformers> $transformersClass
             * @var \Codewithkyrian\Transformers\Transformers|null $transformers
             */
            $transformersClass = 'Codewithkyrian\Transformers\Transformers';
            if (!method_exists($transformersClass, 'setup')) {
                throw new \Exception('Transformers setup method not found');
            }

            $transformers = $transformersClass::setup();
            if (! $transformers) {
                throw new \Exception('Failed to initialize Transformers');
            }

            $transformers->setCacheDir($this->cacheDir)->apply();

            if (! function_exists('Codewithkyrian\Transformers\Pipelines\pipeline')) {
                throw new \Exception('Pipeline function not found');
            }

            /** @var callable $pipe */
            $pipe = \Codewithkyrian\Transformers\Pipelines\pipeline('sentiment-analysis');
            if (! is_callable($pipe)) {
                throw new \Exception('Failed to create sentiment analysis pipeline');
            }

            $result = $pipe($text);
            Assert::isArray($result);

            return $result;
        } catch (\Exception $e) {
            error_log('Transformers sentiment analysis failed: '.$e->getMessage());

            return [
                'error' => $e->getMessage(),
                'status' => 'error',
                'fallback' => true,
            ];
        }
    }
}

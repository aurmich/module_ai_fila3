<?php

/**
 * @see https://dev.to/robertobutti/machine-learning-with-php-5gb
 */

declare(strict_types=1);

namespace Modules\AI\Actions;

// @phpstan-ignore function.notFound
use Codewithkyrian\Transformers\Transformers;
// 002 importing the Transformers class
use Spatie\QueueableAction\QueueableAction;
// 003 importing the pipeline function
use Webmozart\Assert\Assert;

use function Codewithkyrian\Transformers\Pipelines\pipeline;

class SentimentAction
{
    use QueueableAction;

    public function execute(string $prompt): array
    {
        // 004 initializing the Transformers class setting the cache directory for models
        Transformers::setup()->setCacheDir('./../cache/models')->apply();

        // 005 initializing a pipeline for sentiment-analysis
        $pipe = pipeline('sentiment-analysis');
        $prompt = 'The quality of tools in the PHP ecosystem has greatly improved in recent years';
        Assert::isArray($out = $pipe($prompt));

        // array:2 [▼
        //    "label" => "POSITIVE"
        //    "score" => 0.99965798854828
        // ]
        // "time" => 20.914520025253

        return $out;
    }
}

<?php
/**
 * @see https://dev.to/robertobutti/machine-learning-with-php-5gb
 */

declare(strict_types=1);

namespace Modules\AI\Actions;

<<<<<<< HEAD
use function Codewithkyrian\Transformers\Pipelines\pipeline;

// 002 importing the Transformers class
use Codewithkyrian\Transformers\Transformers;
// 003 importing the pipeline function
use Spatie\QueueableAction\QueueableAction;

=======
use Codewithkyrian\Transformers\Transformers;
// 002 importing the Transformers class
use Spatie\QueueableAction\QueueableAction;

// 003 importing the pipeline function
use function Codewithkyrian\Transformers\Pipelines\pipeline;

>>>>>>> 4b612bf07fd8062b38e5db468a4fd29117086a11
class SentimentAction
{
    use QueueableAction;

    public function execute(string $prompt)
    {
        // 004 initializing the Transformers class setting the cache directory for models
        Transformers::setup()->setCacheDir('./../cache/models')->apply();

        // 005 initializing a pipeline for sentiment-analysis
        $pipe = pipeline('sentiment-analysis');
        $prompt = 'The quality of tools in the PHP ecosystem has greatly improved in recent years';
        $out = $pipe($prompt);
        dddx($out);
        // array:2 [▼
        //    "label" => "POSITIVE"
        //    "score" => 0.99965798854828
        // ]
        // "time" => 20.914520025253

        return $out;
    }
}

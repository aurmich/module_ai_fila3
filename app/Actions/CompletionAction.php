<?php

declare(strict_types=1);

namespace Modules\AI\Actions;

use OpenAI\Laravel\Facades\OpenAI;
<<<<<<< HEAD
use Modules\AI\Datas\CompletionData;
=======
<<<<<<< HEAD
use OpenAI\Responses\Completions\CreateResponse;
=======
use Modules\AI\Datas\CompletionData;
>>>>>>> origin/dev
>>>>>>> c7c37b5 (.)
use Spatie\QueueableAction\QueueableAction;

/**
 * CompletionAction is responsible for executing the completion action and returning structured data.
 *
 * This action uses the OpenAI API to generate text based on a given prompt.
 *
 * @see https://platform.openai.com/docs/api-reference/completions
 */
class CompletionAction
{
    use QueueableAction;

    /**
<<<<<<< HEAD
=======
<<<<<<< HEAD
     * Execute the completion action.
     */
    public function execute(string $prompt): CreateResponse
=======
>>>>>>> c7c37b5 (.)
     * Execute the completion action and return structured data.
     *
     * @param string $prompt The prompt to be used for the completion action.
     *
     * @return \Modules\AI\Datas\CompletionData The structured data containing the completion result.
     */
    public function execute(string $prompt): CompletionData
<<<<<<< HEAD
=======
>>>>>>> origin/dev
>>>>>>> c7c37b5 (.)
    {
        $result = OpenAI::completions()->create([
            'model' => 'gpt-3.5-turbo-instruct',
            'prompt' => $prompt,
            'temperature' => 0.5,
            'max_tokens' => 100,
            'top_p' => 1.0,
            'frequency_penalty' => 0.0,
            'presence_penalty' => 0.0,
        ]);

<<<<<<< HEAD
=======
<<<<<<< HEAD
        // OpenAI\Responses\Completions\CreateResponse
        return $result;
        // string
        // return $result['choices'][0]['text'];
=======
>>>>>>> c7c37b5 (.)
        // Map OpenAI response to Data Transfer Object
        $choice = $result->choices[0]->text;
        $usage = $result->usage;
        return new CompletionData(
            text: trim($choice),
            promptTokens: $usage->promptTokens,
            completionTokens: $usage->completionTokens,
            totalTokens: $usage->totalTokens,
        );
<<<<<<< HEAD
=======
>>>>>>> origin/dev
>>>>>>> c7c37b5 (.)
    }
}

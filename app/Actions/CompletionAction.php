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
     * @param string $prompt
     * @return \Modules\AI\Datas\CompletionData
     */
    public function execute(string $prompt): CompletionData
<<<<<<< HEAD
=======
>>>>>>> origin/dev
>>>>>>> c7c37b5 (.)
    {
        $result = OpenAI::completions()->create([
            // 'model' => 'text-davinci-003',
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

/*
The model `text-davinci-003` has been deprecated, learn more here: https://platform.openai.com/docs/deprecations
---
        +text: " a recursive acronym for "PHP: Hypertext Preprocessor". This means that the"
        +index: 0
        +logprobs: null
        +finishReason: "length"
----
a server-side scripting language designed for web development but also used as a general-purpose programming language.
 It is used to create dynamic and interactive web pages, handle form data, manage databases,
 and perform other server-side tasks. PHP code is executed on the server,
 and the resulting HTML is sent to the client's web browser.
 It is a popular choice for web development due to its ease of use, flexibility,
 and wide range of features and functionalities. It is also open-source and has a large community
usage:
OpenAI\Responses\Completions\CreateResponseUsage {#3695 ▼
      +promptTokens: 2
      +completionTokens: 100
      +totalTokens: 102
    }
*/

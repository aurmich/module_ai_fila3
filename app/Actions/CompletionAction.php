<?php

declare(strict_types=1);

namespace Modules\AI\Actions;

use OpenAI\Laravel\Facades\OpenAI;
use OpenAI\Responses\Completions\CreateResponse;
use Spatie\QueueableAction\QueueableAction;

class CompletionAction
{
    use QueueableAction;

    /**
     * Execute the completion action.
     *
     * @param string $prompt
     * @return CreateResponse
     */
    public function execute(string $prompt): CreateResponse
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

        // OpenAI\Responses\Completions\CreateResponse
        return $result;
        // string
        // return $result['choices'][0]['text'];
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

https://cubettech.com/resources/blog/building-ai-powered-web-applications-with-laravel/
https://laravel-news.com/openai-in-laravel
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> e6bfb4f (up)
https://blog.cubed.run/revolutionizing-web-development-the-power-of-ai-and-ml-in-laravel-75c087bacd40

https://ahmadrosid.com/blog/how-to-use-claude-model-in-laravel  // !

https://codewithkyrian.com/p/machine-learning-with-transformersphp-automatically-tagging-posts-in-laravel // !!!
https://codewithkyrian.com/p/announcing-transformersphp-bring-machine-learning-magic-to-your-php-projects
https://codewithkyrian.github.io/transformers-php/introduction
https://dev.to/robertobutti/machine-learning-with-php-5gb

https://huggingface.co/blog/how-to-train 

https://www.aimodels.fyi/

<<<<<<< HEAD
https://linuxwizardry.com/how-to-get-started-with-huggingface-and-ai-on-ubuntu/

https://jewelhuq.medium.com/comprehensive-overview-of-leading-large-language-model-llm-providers-8e92c3a463e4

https://trreta.com/blog/integrating-ai-and-machine-learning-in-laravel


-----
https://www.youtube.com/watch?v=jgz8lr32brY
----- 

=======
>>>>>>> 608c8b3 (up)
=======
>>>>>>> e6bfb4f (up)

~~~php
use TensorFlow\Tensor;

use TensorFlow\Lite\Interpreter;

class ImageRecognitionModel

{

    protected $interpreter;

    public function __construct()

    {

        $this->interpreter = new Interpreter(__DIR__ . ‘/path/to/model.tflite’);

    }

    public function recognize(string $imagePath)

    {

        $inputTensor = $this->interpreter->getInputTensor(0);

        $inputTensor->resize([1, $inputTensor->shape()[1], $inputTensor->shape()[2], $inputTensor->shape()[3]]);

        $inputTensor->setFromFile($imagePath);

        $this->interpreter->invoke();

        $outputTensor = $this->interpreter->getOutputTensor(0);

        return $outputTensor->flat();

    }

}
~~~

------------



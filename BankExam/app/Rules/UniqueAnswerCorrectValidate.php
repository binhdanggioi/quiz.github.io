<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniqueAnswerCorrectValidate implements Rule
{
    private $answers;

    /**
     * Create a new rule instance.
     *
     * @param $answers
     */
    public function __construct($answers)
    {
        $this->answers = $answers;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $correct = [];
        foreach($this->answers as $answer) {
            if ($answer['correct']) {
                array_push($correct, true);
            }
        }
        return count($correct) === 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Mot cau hoi chi duoc phep co 1 cau tra loi dung';
    }
}

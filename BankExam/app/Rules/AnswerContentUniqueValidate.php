<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AnswerContentUniqueValidate implements Rule
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
        $result = [];

        foreach ($this->answers as $key => $answer){
            array_push($result, $answer['content']);
        }

        return count(array_unique($result)) == count($this->answers);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'cau tra loi khong duoc trung nhau';
    }
}

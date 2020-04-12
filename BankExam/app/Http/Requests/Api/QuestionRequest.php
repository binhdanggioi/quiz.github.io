<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use App\Rules\AnswerNumberValidate;
use App\Rules\RequireHaveCorrectAnswerValidate;
use App\Rules\AnswerContentUniqueValidate;
use Illuminate\Http\Request;
use App\Rules\UniqueAnswerCorrectValidate;

class QuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'content' => [
                'required',
                'min:12',
                 new AnswerNumberValidate($request->answers),
                 new RequireHaveCorrectAnswerValidate($request->answers),
                 new AnswerContentUniqueValidate($request->answers),
                new UniqueAnswerCorrectValidate($request->answers),
            ],
            'answers.*.content' => ['required', 'min:3'],
            'answers.*.correct' => ['boolean'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => [
                'status' => false,
                'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'messages' => $validator->errors()
            ]
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }

    public function messages()
    {
        return [
          'content.required' => 'Vui long nhap noi dung cau hoi',
            'content.min' => 'Cau hoi khong duoc nho hon 12 ky tu',
            'answers.*.content.required' => 'Noi dung cau tra loi khong duoc bo trong',
            'answers.*.content.min' => 'Noi dung cau tra loi khong duoc nho hon 3 ky tu',
            'answers.*.correct.boolean' => 'Cau tra loi chi duoc phep la true hoac false'
        ];
    }
}

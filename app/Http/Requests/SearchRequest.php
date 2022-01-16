<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class SearchRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['sometimes', 'nullable', 'regex:/^[가-힣|a-z|A-Z]+$/'],
            'email' => ['sometimes', 'nullable', 'email:filter'],
        ];
    }

    public function messages() {
        return [
            'name.regex' => '이름은 한글, 영어 대문자/소문자 로 입력해주세요',
            'email.email' => '이메일형식을 확인해주세요',
        ];
    }

    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json([
            'error' => $validator->errors()
        ], 400));
    }
}

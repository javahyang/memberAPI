<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class SignupRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'regex:/^[가-힣|a-z|A-Z]+$/'],
            'email' => ['required', 'email:filter'],
            'password' => ['required', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@^$!%*?&])[A-Za-z\d@^$!%*?&]{10,}$/'],
            'c_password' => ['required', 'same:password'],
            'nickname' => ['required', 'regex:/^[a-z]+$/'],
            'phone_number' => ['required', 'numeric'],
            'gender' => [Rule::in(['M', 'F'])],
        ];
    }

    public function messages()
    {
        return [
            'name.regex' => '이름은 한글, 영어 대문자/소문자 로 입력해주세요',
            'email.email' => '이메일형식을 확인해주세요',
            'password.regex' => '비밀번호는 영어 대문자, 소문자, 특수문자(@^$!%*?&), 숫자가 각 1회 이상씩 포함된 10자리 이상이어야 합니다.',
            'c_password.same' => '동일한 비밀번호를 입력해주세요',
            'nickname.regex' => '닉네임은 영어 소문자 로 입력해주세요',
            'phone_number.numeric' => '전화번호는 숫자만 입력해주세요',
            'gender.in' => '올바른 타입을 입력해주세요: 남성(M), 여성(F)'
        ];
    }

    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json([
            'error' => $validator->errors()
        ], 400));
    }
}

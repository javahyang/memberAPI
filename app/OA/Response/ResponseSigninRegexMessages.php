<?php

namespace App\OA\Response;

/**
 * @OA\Schema(
 *      title="Response Signin Regex Messages",
 *      description="로그인 요청값 정규식 오류메시지 배열",
 *      type="object"
 * )
 */

 class ResponseSigninRegexMessages
 {
    /**
     * @OA\Property(
     *      title="email",
     *      description="이메일 정규식 오류메시지",
     *      @OA\Items(
     *          type="string",
     *          example="이메일형식을 확인해주세요"
     *      )
     * )
     *
     * @var array
     */
    public $email;

    /**
     * @OA\Property(
     *      title="password",
     *      description="비밀번호 정규식 오류메시지",
     *      @OA\Items(
     *          type="string",
     *          example="비밀번호는 영어 대문자, 소문자, 특수문자(@^$!%*?&), 숫자가 각 1회 이상씩 포함된 10자리 이상이어야 합니다."
     *      )
     * )
     *
     * @var array
     */
    public $password;
 }

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
     *          example="이메일을 입력해주세요"
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
     *          example="비밀번호를 입력해주세요"
     *      )
     * )
     *
     * @var array
     */
    public $password;
 }

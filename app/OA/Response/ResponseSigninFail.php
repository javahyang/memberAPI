<?php

namespace App\OA\Response;

/**
 * @OA\Schema(
 *      title="Response Signin Fail",
 *      description="로그인 정보 오류메시지",
 *      type="object"
 * )
 */

 class ResponseSigninFail
 {
    /**
     * @OA\Property(
     *      title="error",
     *      description="로그인 실패",
     *      example="이메일주소 또는 비밀번호를 확인해주세요"
     * )
     *
     * @var string
     */
    public $error;
 }

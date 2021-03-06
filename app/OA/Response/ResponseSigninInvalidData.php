<?php

namespace App\OA\Response;

/**
 * @OA\Schema(
 *      title="Response Signin Invalid Data",
 *      description="로그인 요청값 정규식 오류메시지",
 *      type="object"
 * )
 */

 class ResponseSigninInvalidData
 {
    /**
     * @OA\Property(
     *      title="error",
     *      description="오류메시지 배열",
     *      ref="#/components/schemas/ResponseSigninRegexMessages"
     * )
     *
     * @var string
     */
    public $error;
 }

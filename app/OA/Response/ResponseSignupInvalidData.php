<?php

namespace App\OA\Response;

/**
 * @OA\Schema(
 *      title="Response Signup Invalid Data",
 *      description="회원가입 요청값 정규식 오류메시지",
 *      type="object"
 * )
 */

 class ResponseSignupInvalidData
 {
    /**
     * @OA\Property(
     *      title="error",
     *      description="오류메시지 배열",
     *      ref="#/components/schemas/ResponseRegexMessages"
     * )
     *
     * @var array
     */
    public $error;
 }

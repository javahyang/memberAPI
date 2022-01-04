<?php

namespace App\OA\Response;

/**
 * @OA\Schema(
 *      title="Response Users Invalid Data",
 *      description="회원검색 요청값 정규식 오류메시지",
 *      type="object"
 * )
 */

 class ResponseUsersInvalidData
 {
    /**
     * @OA\Property(
     *      title="error",
     *      description="오류메시지 배열",
     *      ref="#/components/schemas/ResponseUsersRegexMessages"
     * )
     *
     * @var array
     */
    public $error;
 }

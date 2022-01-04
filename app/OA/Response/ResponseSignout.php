<?php

namespace App\OA\Response;

/**
 * @OA\Schema(
 *      title="Response Signout",
 *      description="로그아웃 응답 데이터",
 *      type="object"
 * )
 */

 class ResponseSignout
 {
     /**
     * @OA\Property(
     *      title="message",
     *      description="응답메시지",
     *      example="로그아웃 되었습니다."
     * )
     *
     * @var string
     */
    public $message;
 }

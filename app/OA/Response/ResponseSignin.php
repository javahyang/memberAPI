<?php

namespace App\OA\Response;

/**
 * @OA\Schema(
 *      title="Response Signin",
 *      description="로그인 성공",
 *
 * )
 */

class ResponseSignin
{
    /**
     * @OA\Property(
     *      title="success",
     *      description="로그인 성공",
     *      ref="#/components/schemas/ResponseToken"
     * )
     *
     * @var array
     */
    public $success;
}

<?php

namespace App\OA\Request;

/**
 * @OA\Schema(
 *      title="Request Signin",
 *      description="로그인 요청 데이터",
 *      type="object"
 * )
 */

class RequestSignin
{
    /**
     * @OA\Property(
     *      title="email",
     *      description="이메일주소: 이메일형식",
     *      example="gildong@test.com"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="password",
     *      description="비밀번호: 영어 대문자, 소문자, 특수문자(@^$!%*?&), 숫자가 각 1회 이상씩 포함된 10자리 이상",
     *      example="Bawen&a1qq"
     * )
     *
     * @var string
     */
    public $password;
}

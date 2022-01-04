<?php

namespace App\OA\Request;

/**
 * @OA\Schema(
 *      title="Request Users",
 *      description="회원검색 요청 데이터",
 *      type="object"
 * )
 */

class RequestUsers
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="이름: 한글, 영어 대문자/소문자",
     *      example="홍길동"
     * )
     *
     * @var string
     */
    public $name;

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
}

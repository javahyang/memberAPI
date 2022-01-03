<?php

namespace App\OA\Request;

/**
 * @OA\Schema(
 *      title="Request Signup",
 *      description="회원가입 입력 데이터",
 *      type="object",
 *      required={"name", "email", "password", "c_password", "nickname", "phone_number"}
 * )
 */

class RequestSignup
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

    /**
     * @OA\Property(
     *      title="c_password",
     *      description="비밀번호 확인: password 필드와 같은 값",
     *      example="Bawen&a1qq"
     * )
     *
     * @var string
     */
    public $c_password;

    /**
     * @OA\Property(
     *      title="nickname",
     *      description="닉네임: 영어 소문자",
     *      example="hongho"
     * )
     *
     * @var string
     */
    public $nickname;

    /**
     * @OA\Property(
     *      title="phone_number",
     *      description="전화번호: 숫자만",
     *      example="01012342345"
     * )
     *
     * @var string
     */
    public $phone_number;

    /**
     * @OA\Property(
     *      title="gender",
     *      description="성별: 남성(M), 여성(F)",
     *      example="M"
     * )
     *
     * @var string
     */
    public $gender;
}

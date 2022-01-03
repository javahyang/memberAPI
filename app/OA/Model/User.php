<?php

namespace App\OA\Model;

/**
 *
 * @OA\Schema(
 *     title="User",
 *     description="User 데이터",
 *     @OA\Xml(
 *         name="User"
 *     )
 * )
 */

class User
{
    /**
     * @OA\Property(
     *     title="id",
     *     description="Id",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *      title="name",
     *      description="회원 이름",
     *      example="홍길동"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="email",
     *      description="회원 이메일주소(아이디)",
     *      example="gildong@test.com"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="nickname",
     *      description="닉네임",
     *      example="hongho"
     * )
     *
     * @var string
     */
    public $nickname;

    /**
     * @OA\Property(
     *      title="phone_number",
     *      description="전화번호",
     *      example="01012342345"
     * )
     *
     * @var string
     */
    public $phone_number;

    /**
     * @OA\Property(
     *      title="gender",
     *      description="성별: 남성(M), 여성(F), null",
     *      example="M"
     * )
     *
     * @var string
     */
    public $gender;
}

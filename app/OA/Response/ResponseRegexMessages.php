<?php

namespace App\OA\Response;

/**
 * @OA\Schema(
 *      title="Regex Messages",
 *      description="회원가입 입력 정규식 오류메시지 배열",
 *      type="object"
 * )
 */

 class ResponseRegexMessages
 {
    /**
     * @OA\Property(
     *      title="name",
     *      description="이름 정규식 오류메시지",
     *      @OA\Items(
     *          type="string",
     *          example="이름은 한글, 영어 대문자/소문자 로 입력해주세요"
     *      )
     * )
     *
     * @var array
     */
    public $name;

    /**
     * @OA\Property(
     *      title="email",
     *      description="이메일 정규식 오류메시지",
     *      @OA\Items(
     *          type="string",
     *          example="이메일형식을 확인해주세요"
     *      )
     * )
     *
     * @var array
     */
    public $email;

    /**
     * @OA\Property(
     *      title="password",
     *      description="비밀번호 정규식 오류메시지",
     *      @OA\Items(
     *          type="string",
     *          example="비밀번호는 영어 대문자, 소문자, 특수문자(@^$!%*?&), 숫자가 각 1회 이상씩 포함된 10자리 이상이어야 합니다."
     *      )
     * )
     *
     * @var array
     */
    public $password;

    /**
     * @OA\Property(
     *      title="c_password",
     *      description="비밀번호 확인 정규식 오류메시지",
     *      @OA\Items(
     *          type="string",
     *          example="동일한 비밀번호를 입력해주세요"
     *      )
     * )
     *
     * @var array
     */
    public $c_password;

    /**
     * @OA\Property(
     *      title="nickname",
     *      description="닉네임 정규식 오류메시지",
     *      @OA\Items(
     *          type="string",
     *          example="닉네임은 영어 소문자 로 입력해주세요"
     *      )
     * )
     *
     * @var array
     */
    public $nickname;

    /**
     * @OA\Property(
     *      title="phone_number",
     *      description="전화번호 정규식 오류메시지",
     *      @OA\Items(
     *          type="string",
     *          example="전화번호는 숫자만 입력해주세요"
     *      )
     * )
     *
     * @var array
     */
    public $phone_number;

    /**
     * @OA\Property(
     *      title="gender",
     *      description="성별 정규식 오류메시지",
     *      @OA\Items(
     *          type="string",
     *          example="올바른 타입을 입력해주세요: 남성(M), 여성(F)"
     *      )
     * )
     *
     * @var array
     */
    public $gender;
 }

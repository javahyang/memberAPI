<?php

namespace App\OA\Response;

/**
 * @OA\Schema(
 *      title="Response Users Regex Messages",
 *      description="회원검색 요청값 정규식 오류메시지 배열",
 *      type="object"
 * )
 */

 class ResponseUsersRegexMessages
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
 }

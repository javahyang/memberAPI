<?php

namespace App\OA\Response;

/**
 * @OA\Schema(
 *      title="Response Users Details",
 *      description="회원 상세정보",
 *      type="object"
 * )
 */

 class ResponseUsersDetails
 {
     /**
     * @OA\Property(
     *      title="user",
     *      description="로그인한 회원정보",
     *      ref="#/components/schemas/User"
     * )
     *
     * @var array
     */
     public $user;
 }

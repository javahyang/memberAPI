<?php

namespace App\OA\Response;

/**
 * @OA\Schema(
 *      title="Response Orders Details",
 *      description="주문목록 응답 데이터",
 *      type="object"
 * )
 */

 class ResponseOrdersDetails
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

    /**
     * @OA\Property(
     *      title="orders",
     *      description="회원의 주문목록(결제일시 최신순)",
     *      @OA\Items(
     *          type="object",
     *          ref="#/components/schemas/Order"
     *      )
     * )
     *
     * @var array
     */
    public $orders;
 }

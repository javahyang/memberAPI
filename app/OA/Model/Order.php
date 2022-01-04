<?php

namespace App\OA\Model;

/**
 *
 * @OA\Schema(
 *     title="Order",
 *     description="Order 데이터",
 *     @OA\Xml(
 *         name="Order"
 *     )
 * )
 */

class Order
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
     *      title="order_number",
     *      description="주문번호",
     *      example="QMAYTOPQN6R0"
     * )
     *
     * @var string
     */
    public $order_number;

    /**
     * @OA\Property(
     *      title="product_name",
     *      description="제품명",
     *      example="수제 인센스 홀더 🦉"
     * )
     *
     * @var string
     */
    public $product_name;

    /**
     * @OA\Property(
     *      title="paid_at",
     *      description="결제일시",
     *      example="2021-03-12T10:01:57.000000Z"
     * )
     *
     * @var datetime
     */
    public $paid_at;
}

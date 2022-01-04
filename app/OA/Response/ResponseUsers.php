<?php

namespace App\OA\Response;

/**
 * @OA\Schema(
 *      title="Response Users",
 *      description="회원목록",
 *      type="object"
 * )
 */

 class ResponseUsers
 {
     /**
     * @OA\Property(
     *      title="data",
     *      description="회원목록",
     *      @OA\Items(
     *          type="object",
     *          ref="#/components/schemas/User"
     *      )
     * )
     *
     * @var array
     */
     public $data;
 }

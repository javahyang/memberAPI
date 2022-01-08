<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/orders/details",
     *      tags={"주문"},
     *      summary="주문 목록조회",
     *      description="로그인한 회원의 주문 목록조회 API",
     *      security={ {"bearer_token": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="로그인한 회원의 주문 목록을 반환합니다.",
     *          @OA\JsonContent(ref="#/components/schemas/ResponseOrdersDetails")
     *      )
     * )
     */
    /**
     * Orders details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        $email = $user->email;
        $result['user'] = $user;
        $result['orders'] = Order::where('email', $email)
                                ->latest('paid_at')
                                ->get();
        return response()->json($result, 200);
    }
}

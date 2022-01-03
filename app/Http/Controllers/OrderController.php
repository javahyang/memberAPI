<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function details()
    {
        $user = Auth::user();
        $email = $user->email;
        $success['user'] = $user;
        $success['orders'] = Order::where('email', $email)
                                ->orderBy('paid_at', 'desc')
                                ->get();
        return response()->json(['success' => $success], 200);
    }
}

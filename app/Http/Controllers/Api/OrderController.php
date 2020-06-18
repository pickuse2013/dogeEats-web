<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Order\Order;
use Auth;

class OrderController extends Controller
{
    public function orders(Request $request)
    {
        return Order::with('user')->where('user_id', Auth::user()->id);
    }
}

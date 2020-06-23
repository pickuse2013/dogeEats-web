<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Order;
use Auth;

class OrderController extends Controller
{
    public function orders(Request $request)
    {
        return Order::with('details.product')->where('user_id', Auth::user()->id)->get();
    }

    public function currentOrder(Request $request)
    {
        return Order::with('details.product')->where('user_id', Auth::user()->id)->whereIn('status', [0,1,2])->get();
    }
}

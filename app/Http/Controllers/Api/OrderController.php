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
        return Order::where('user_id', Auth::user()->id)->get();
    }
}

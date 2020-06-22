<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\Order;

class TransporterController extends Controller
{
    public function active()
    {
        Auth::user()->transporter()->update(['active' => true]);
        if(Auth::user()->transporter->assigment_order_id == null)
        {
            $order = Order::where('status', 0)->where('transporter_id', null)->first();
            if($order != null)
            {
                $order->update(['transporter_id' => Auth::user()->id]);
                Auth::user()->transporter()->update(['assigment_order_id' => $order->id]);

            }
        }



        return json_encode(['message' => 'success']);
    }

    public function deactive()
    {
        Auth::user()->transporter()->update(['active' => true]);
        return json_encode(['message' => 'success']);
    }

    public function order()
    {
        if(Auth::user()->transporter->assigment_order_id == null)
        {
            return json_encode(['message' => 'no order available']);
        }

        return Auth::user()->transporter->order;
    }

    public function finishOrder()
    {
        if(Auth::user()->transporter->assigment_order_id == null)
        {
            return json_encode(['message' => 'no order available']);
        }

        Auth::user()->transporter->order()->update(['status' => '3']);
        Auth::user()->transporter->update(['assigment_order_id' => null]);
        return json_encode(['message' => 'success']);
    }

    public function getFood()
    {
        if(Auth::user()->transporter->assigment_order_id == null)
        {
            return json_encode(['message' => 'no order available']);
        }

        Auth::user()->transporter->order()->update(['status' => '2']);
        return json_encode(['message' => 'success']);
    }
}

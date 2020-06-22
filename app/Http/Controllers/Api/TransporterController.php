<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class TransporterController extends Controller
{
    public function active()
    {
        Auth::user()->transporter()->update(['active' => true]);
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
}

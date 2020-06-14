<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Restaurant;

class RestaurantController extends Controller
{
    public function restaurants()
    {
        return Restaurant::All();
    }

    public function restaurant($id)
    {
        return Restaurant::with('categories.products.options')->findOrFail($id);
    }

    public function favorites()
    {
        //TODO: FINISH IT
        //return Restaurant::with('categories.products.options')->findOrFail($id);
    }
}

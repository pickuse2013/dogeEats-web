<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Restaurant;
use App\User;

use Auth;

class RestaurantController extends Controller
{
    public function restaurants(Request $request)
    {
        if ($request->has('name')) {
            return Restaurant::where('name', 'like', '%' . $request->name . '%')->get();
        } else {
            return Restaurant::All();
        }
    }

    //TODO: can be remove
    public function restaurant($id)
    {
        return Restaurant::with('categories.products.options')->findOrFail($id);
    }

    public function restaurantJson(Request $request)
    {
        return Restaurant::with('categories.products.options')->findOrFail($request->id);
    }

    public function favorites()
    {
        $user = User::with('favorite_restaurants.restaurant')->findOrFail(Auth::user()->id);
        return $user->favorite_restaurants;
    }

    public function addFavoriteJson(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        $user->favorite_restaurants()->create([
            'user_id' => $user->id,
            'restaurant_id' => $request->id
        ]);

        return $this->success_message();
    }

    public function addFavorite($id)
    {
        $user = User::findOrFail(Auth::user()->id);

        $user->favorite_restaurants()->create([
            'user_id' => $user->id,
            'restaurant_id' => $id
        ]);

        return $this->success_message();
    }

    public function deleteFavoriteJson(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        $user->favorite_restaurants()->where('restaurant_id', $request->id)->delete();

        return $this->success_message();
    }

    private function success_message()
    {
        return json_encode(['message' => 'success']);
    }
}

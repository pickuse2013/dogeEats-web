<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'restaurant_id', 'user_id'
    ];

    public static function clearCart($user_id, $force = true, $restaurant_id = 0)
    {
        if ($force == true) {
            Cart::where('user_id', $user_id)->delete();
        } else {
            $cart = Cart::where('user_id', $user_id)->get()->last();

            if ($cart->restaurant_id != $restaurant_id) {
                Cart::where('user_id', $user_id)->delete();
                return null;
            } else {
                return $cart;
            }
        }
    }


    public function products()
    {
        return $this->hasMany(\App\Model\Cart\Product::class);
    }
}

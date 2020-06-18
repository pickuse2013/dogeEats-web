<?php

namespace App\Model\Order;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function details()
    {
        return $this->hasMany('App\Order\Detail', 'order_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(\App\User::class, 'user_id', 'id');
    }

    public function restaurant()
    {
        return $this->hasOne(\App\Model\Restaurant::class, 'restaurant_id', 'id');
    }
}

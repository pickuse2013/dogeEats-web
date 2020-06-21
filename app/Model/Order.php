<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['restaurant_id', 'user_id', 'address_source', 'address_destination', 'position_source', 'position_destination', 'transporter_id', 'custom'];
    public function details()
    {
        return $this->hasMany(\App\Model\Order\Detail::class, 'order_id', 'id');
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

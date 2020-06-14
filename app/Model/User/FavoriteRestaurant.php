<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;

class FavoriteRestaurant extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_favorite_restaurants';

    public function restaurant()
    {
        $this->hasOne('App\Model\Restaurant', 'id', 'restaurant_id');
    }
}

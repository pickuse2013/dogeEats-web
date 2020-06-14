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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'restaurant_id'
    ];

    public function restaurant()
    {
        //$this->hasOne('App\Model\Restaurant', 'id', 'restaurant_id');
        return $this->belongsTo('App\Model\Restaurant', 'restaurant_id', 'id');
        
    }
}

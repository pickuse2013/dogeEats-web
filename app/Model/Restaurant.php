<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'address'
    ];

    // public function products()
    // {
    //     //TODO: return all child products
    //     return $this->hasMany('App\Model\Product\Category', 'restaurant_id', 'id');
    // }

    public function categories()
    {
        return $this->hasMany('App\Model\Product\Category', 'restaurant_id', 'id');
    }
}

<?php

namespace App\Model\Product;

use Illuminate\Database\Eloquent\Model;

/**
 * 商品分類
 */
class Category extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'restaurant_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function products()
    {
        return $this->hasMany('App\Model\Product\Product', 'category_id', 'id');
    }
}

<?php

namespace App\Model\Cart;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cart_product_options';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['cart_product_id', 'option_id', 'option'];

    public function option_name()
    {
        return $this->belongsTo(\App\Model\Product\Option::class, 'option_id', 'id');
    }
}

<?php

namespace App\Model\Order;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['order_id', 'product_id', 'custom', 'count'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    public function order()
    {
        return $this->belongsTo(\App\Model\Order\Order::class, "order_id", "id");
    }

    public function options()
    {
        return $this->hasMany(\App\Model\Order\Option::class, "order_detail_id", "id");
    }

    public function product()
    {
        return $this->hasOne(\App\Model\Product::class, "id", "product_id");
    }
}

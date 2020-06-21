<?php

namespace App\Model\Order;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_options';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['order_detail_id', 'option_id', 'option'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    public function option()
    {
        return $this->belongsTo(\App\Model\Product\Option\Detail::class, "option_id", "id");
    }
}

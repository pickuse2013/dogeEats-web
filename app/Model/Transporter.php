<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Transporter extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'assigment_order_id'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function order()
    {
        return $this->hasOne(\App\Model\Order::class, 'id', 'assigment_order_id');
    }
}

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


    public function order()
    {
        return $this->belongsTo(\App\Model\Order\Order::class, "order_id", "id");
    }
}

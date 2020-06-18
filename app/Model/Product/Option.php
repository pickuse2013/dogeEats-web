<?php

namespace App\Model\Product;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_options';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    public function details()
    {
        return $this->hasMany(\App\Model\Product\Option\Detail::class, '');
    }
}

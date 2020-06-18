<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_options', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('restaurant_id')->comment('店家id');
            $table->bigInteger('product_id')->comment('商品id');
            $table->string('name')->comment('選項名稱');
            $table->string('option_type')->default('checkbox'); //or radio
        });


        \DB::table('product_options')->insert([
            [
                'restaurant_id' => '1',
                'product_id' => '1',
                'name' => '辣度',
                'option_type' => 'radio'
            ],
            [
                'restaurant_id' => '1',
                'product_id' => '3',
                'name' => '加料',
                'option_type' => 'checkbox'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_options');
    }
}

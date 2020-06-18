<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOptionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_option_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('option_id');
            $table->string('option');
            $table->integer('price');
        });

        \DB::table('product_option_details')->insert([
            [
                'option_id' => '1',
                'option' => '小辣',
                'price' => 0
            ],
            [
                'option_id' => '1',
                'option' => '中辣',
                'price' => 0
            ],
            [
                'option_id' => '1',
                'option' => '大辣',
                'price' => 0
            ]
        ]);

        \DB::table('product_option_details')->insert([
            [
                'option_id' => '2',
                'option' => '加起司',
                'price' => 100
            ],
            [
                'option_id' => '2',
                'option' => '加醬料',
                'price' =>50
            ],
            [
                'option_id' => '2',
                'option' => '加大',
                'price' =>40
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
        Schema::dropIfExists('product_option_details');
    }
}

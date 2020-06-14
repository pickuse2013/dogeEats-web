<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->comment('商品分類id')->nullable();
            $table->string('name');
            $table->string('description')->comment('說明');
            $table->integer('price')->comment('價格');
            $table->string('image_url')->nullable()->comment('圖片位址');
            $table->timestamps();
        });


        \DB::table('products')->insert([
            [
                'category_id' => '1',
                'name' => '標準大雞排',
                'description' => '新鮮的炸雞排',
                'price' => '100'
            ],
            [
                'category_id' => '1',
                'name' => '標準小雞排',
                'description' => '新鮮的炸雞排',
                'price' => '100'
            ],
            [
                'category_id' => '2',
                'name' => '凱薩沙拉',
                'description' => '油膩食品的配角，可以讓你稍微活著久一點',
                'price' => '70'
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
        Schema::dropIfExists('products');
    }
}

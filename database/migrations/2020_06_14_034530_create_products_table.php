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
            $table->text('image_url')->nullable()->comment('圖片位址');
            $table->timestamps();
        });


        \DB::table('products')->insert([
            [
                'category_id' => '1',
                'name' => '標準大雞排',
                'description' => '新鮮的炸雞排',
                'price' => '100',
                'image_url' => "https://media.zenfs.com/en/yahoo__216/19c7202e0e02977ff82b28f3803b1d96"
            ],
            [
                'category_id' => '1',
                'name' => '標準小雞排',
                'description' => '新鮮的炸雞排',
                'price' => '100',
                'image_url' => "https://media.zenfs.com/en/yahoo__216/19c7202e0e02977ff82b28f3803b1d96"
            ],
            [
                'category_id' => '2',
                'name' => '凱薩沙拉',
                'description' => '油膩食品的配角，可以讓你稍微活著久一點',
                'price' => '70',
                'image_url' => 'https://pic.pimg.tw/anthony0520/1438119347-2549514926_n.jpg'
            ],
            [
                'category_id' => '3',
                'name' => '奶油白醬麵',
                'description' => '起司粉可能不用錢',
                'price' => '110',
                'image_url' => 'https://cdn.mamaclub.com/wp-content/uploads/2019/04/20190420_s0601-810x424.jpg'
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

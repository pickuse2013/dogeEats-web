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
            $table->json('option')->comment('選項');
            $table->timestamps();
        });

        \DB::table('product_options')->insert([
            [
                'restaurant_id' => '1',
                'product_id' => '1',
                'name' => '辣度',
                'option' => json_encode([
                    'name' => '辣度',
                    'type' => 'radio',
                    'options' => [
                        [
                            'name' => '大辣',
                        ],
                        [
                            'name' => '中辣',
                        ],
                        [
                            'name' => '小辣',
                        ],
                        [
                            'name' => '不辣',
                        ]
                    ]
                ])
            ],
            [
                'restaurant_id' => '1',
                'product_id' => '3',
                'name' => '加料',
                'option' => json_encode([
                    'name' => '加料',
                    'type' => 'checkbox',
                    'options' => [
                        [
                            'name' => '豪華起司',
                            'price'=> '100'
                        ],
                        [
                            'name' => '加生菜',
                            'price'=> '100'
                        ],
                        [
                            'name' => '豪華醬料組',
                            'price'=> '300'
                        ]
                    ]
                ])
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

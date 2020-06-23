<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('service_fee')->default('0')->comment('服務費'); // 1-3
            $table->string('address')->nullable()->comment('地址');
            $table->string('position')->nullable()->comment('座標');
            $table->string('img_url')->comment('url');
            $table->timestamps();
        });

        \DB::table('restaurants')->insert(
            [
                'name' => '肯德基KFC-台北八德餐廳',
                'description'=> '美式炸雞店',
                'address' => '100台北市中正區八德路一段64號',
                'position' => '25.0431988,121.5313617',
                'img_url' => 'https://resource01-proxy.ulifestyle.com.hk/res/v3/image/content/2575000/2578798/BlackDiamondTruffleCOB_PR_LTO_A3_1024.jpg'
            ]
        );

        \DB::table('restaurants')->insert(
            [
                'name' => '嵐迪義大利麵館',
                'description'=> '只是義大利麵',
                'address' => '100台北市中正區八德路一段82巷9弄1號',
                'position' => "25.0431988,121.5313617",
                "img_url" => "https://candicecity.com/wp-content/uploads/flickr/21318023508_633fb3d1eb_b.jpg"
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurants');
    }
}

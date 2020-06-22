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
            $table->timestamps();
        });

        \DB::table('restaurants')->insert(
            [
                'name' => '肯德基KFC-台北八德餐廳',
                'description'=> '肯德基是源自美國的快餐連鎖店，總部設於肯塔基州路易維爾市，以炸雞為主力產品。總體來說是全球第二大的餐飲連鎖企業，僅次於麥當勞，截至2015年12月，在123個國家和地區擁有20,000+個分店。目前與必勝客、塔可鐘同為美國跨國餐飲集團百勝旗下子公司。',
                'address' => '100台北市中正區八德路一段64號',
                'position' => '25.0431988,121.5313617'
            ]
        );

        \DB::table('restaurants')->insert(
            [
                'name' => '嵐迪義大利麵館',
                'description'=> '只是義大利麵',
                'address' => '100台北市中正區八德路一段82巷9弄1號',
                'position' => '25.0431988,121.5313617'
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

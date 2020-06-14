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
            $table->timestamps();
        });

        \DB::table('restaurants')->insert(
            [
                'name' => '北科雞排大王',
                'description'=> '新鮮的炸雞排專賣店，就開在北科',
                'address' => '106台北市大安區忠孝東路三段1號'
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

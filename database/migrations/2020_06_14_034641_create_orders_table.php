<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('restaurant_id')->comment('店家id');
            $table->string('address_source')->comment('出發地點');
            $table->string('address_destination')->comment('目的地點');
            $table->bigInteger('transporter_id')->comment('外送員id')->nullable();
            $table->text('custom')->comment('訂單客製化選項');
            $table->timestamps();
        });
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

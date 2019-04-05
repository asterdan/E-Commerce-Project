<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('payer_name');
            $table->string('payer_last_name');
            $table->string('payer_email');
            $table->integer('payment_amount');
            $table->string('payment_currency');
            $table->string('product_name');
            $table->integer('product_price');
            $table->string('product_price_currency');
            $table->integer('shipping_address_id');
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
        Schema::dropIfExists('order_details');
    }
}

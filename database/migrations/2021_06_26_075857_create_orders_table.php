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
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->decimal('subtotal')->default(0);
            $table->integer('discount')->default(0);
            $table->integer('item_discount')->default(0);
            $table->decimal('shipping')->default(0);
            $table->string('promo')->nullable();
            $table->decimal('grandtotal')->default(0);
            $table->text('content')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('address');
            $table->string('phone');
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
        Schema::dropIfExists('orders');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->text('content');
            $table->string('coupen_code',255);
            $table->text('image')->default('default_reward')->nullable();
            $table->string('qr_code',255);
            $table->date('start_date');
            $table->date('expiry_date');
            $table->string('discount_unit',50);
            $table->integer('discount');
            $table->tinyInteger('minimum_order');
            $table->tinyInteger('is_reward_allowed');
            $table->tinyInteger('is_direct_application');
            $table->integer('reward_Point');
            $table->tinyInteger('enable');
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
        Schema::dropIfExists('vouchers');
    }
}

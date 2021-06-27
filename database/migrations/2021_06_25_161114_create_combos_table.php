<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCombosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combos', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->text('content');
            $table->text('image')->default('default_reward')->nullable();
            $table->decimal('acture_price');
            $table->decimal('discount_price');
            $table->date('start_date');
            $table->date('expiry_date');
            $table->tinyInteger('status')->default(1);  
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
        Schema::dropIfExists('combos');
    }
}

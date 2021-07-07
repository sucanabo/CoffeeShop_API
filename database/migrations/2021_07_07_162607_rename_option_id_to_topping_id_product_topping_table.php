<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameOptionIdToToppingIdProductToppingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_toppings', function (Blueprint $table) {
            $table->renameColumn('option_id', 'topping_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_toppings', function (Blueprint $table) {
            $table->renameColumn('topping_id', 'option_id');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mess_menus', function (Blueprint $table) {
//            $table->double('tentative_price', 5,2)->after('menu_items')->nullable();
            $table->string('meal_type')->after('menu_items')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mess_menus', function (Blueprint $table) {
            //
        });
    }
};

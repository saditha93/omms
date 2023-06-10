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
        Schema::create('mess_daily_rations', function (Blueprint $table) {
            $table->id();
            $table->integer('mess_id');
            $table->integer('mess_menu_id');
//            $table->string('meal_time');
//            $table->integer('meal_type');
            $table->double('tentative_price', 5,2);
            $table->date('date');
            $table->integer('dessert')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('version')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mess_daily_rations');
    }
};

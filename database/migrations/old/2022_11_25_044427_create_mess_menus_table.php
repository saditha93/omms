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
        Schema::create('mess_menus', function (Blueprint $table) {
            $table->id();
            $table->string('menu_name');
            $table->string('remarks')->nullable();
            $table->json('menu_items');
            $table->integer('status')->default('0');
            $table->integer('mess_id');
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
        Schema::dropIfExists('mess_menus');
    }
};

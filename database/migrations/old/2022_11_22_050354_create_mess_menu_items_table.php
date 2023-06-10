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
        Schema::create('mess_menu_items', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('category_id')->index()->nullable();
            $table->foreign('category_id')->references('id')->on('mess_menu_item_categories');
            $table->integer('status')->default('0');
            $table->string('item_name');
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
        Schema::dropIfExists('mess_menu_items');
    }
};

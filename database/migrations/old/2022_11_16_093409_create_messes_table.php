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
        Schema::create('messes', function (Blueprint $table) {
            $table->id();
            $table->integer('estb');
            $table->string('name');
            $table->string('location');
            $table->string('code');
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
        Schema::dropIfExists('messes');
    }
};

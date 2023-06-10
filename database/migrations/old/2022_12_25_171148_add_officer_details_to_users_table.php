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
        Schema::table('users', function (Blueprint $table) {
            $table->string('service_no')->after('email')->nullable();
            $table->string('rank')->after('service_no')->nullable();
            $table->string('full_name')->after('rank')->nullable();
            $table->string('name_according_to_part2')->after('full_name')->nullable();
            $table->string('regiment')->after('name_according_to_part2')->nullable();
            $table->string('unit')->after('regiment')->nullable();
            $table->string('nic')->after('unit')->nullable();
            $table->string('mess_id')->after('nic')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};

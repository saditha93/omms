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
            $table->string('menu_type')->after('menu_name')->nullable()->default(null);
            $table->string('menu_code')->after('menu_type')->nullable()->default(null);
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

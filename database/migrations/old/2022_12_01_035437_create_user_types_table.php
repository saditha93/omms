<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_types', function (Blueprint $table) {
            $table->id();
            $table->string('user_type');
            $table->timestamps();
        });

        DB::table('user_types')->insert([
            ['user_type' => 'super-admin','created_at'=> Carbon::now()],
            ['user_type' => 'mess-manager','created_at'=> Carbon::now()],
            ['user_type' => 'ration-clerk','created_at'=> Carbon::now()],
            ['user_type' => 'barman','created_at'=> Carbon::now()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_types');
    }
};

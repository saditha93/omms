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
        Schema::create('mess_menu_item_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('version')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('mess_menu_item_categories')->insert([
            ['category_name' => 'Ration','created_at'=> Carbon::now()],
            ['category_name' => 'Tea','created_at'=> Carbon::now()],
            ['category_name' => 'Bar','created_at'=> Carbon::now()],
            ['category_name' => 'Extra Messing','created_at'=> Carbon::now()],
            ['category_name' => 'Dessert','created_at'=> Carbon::now()],
            ['category_name' => 'Other Items','created_at'=> Carbon::now()],
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mess_menu_item_categories');
    }
};

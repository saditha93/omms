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
        Schema::create('ahq_establishment_users', function (Blueprint $table) {
            $table->id();
            $table->string('admin_id');
            $table->string('ahq_establishment_id');
            $table->string('e_number');
            $table->string('full_name');
            $table->string('name_accdng_to_part_2');
            $table->string('service_no');
            $table->string('rank');
            $table->string('regiment');
            $table->string('unit');
            $table->string('nic');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('ahq_establishment_users');
    }
};

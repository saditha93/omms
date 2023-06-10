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
        Schema::create('establishments', function (Blueprint $table) {
            $table->id();
            $table->string('establishment');
            $table->string('abbr');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('version')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('establishments')->insert([
            ['establishment' => '1 Corps','abbr' => '1-corps','created_at'=> Carbon::now()],
            ['establishment' => 'Security Forces Headquarters - Jaffna','abbr' => 'SFHQ-J','created_at'=> Carbon::now()],
            ['establishment' => 'Security Forces Headquarters - Wanni','abbr' => 'SFHQ-W','created_at'=> Carbon::now()],
            ['establishment' => 'Security Forces Headquarters - East','abbr' => 'SFHQ-E','created_at'=> Carbon::now()],
            ['establishment' => 'Security Forces Headquarters - Mullaittivu','abbr' => 'SFHQ-MLT','created_at'=> Carbon::now()],
            ['establishment' => 'Security Forces Headquarters - West','abbr' => 'SFHQ-West','created_at'=> Carbon::now()],
            ['establishment' => 'Security Forces Headquarters - Central','abbr' => 'SFHQ-Cen','created_at'=> Carbon::now()],

            ['establishment' => 'Sri Lanka Armoured Corps','abbr' => 'SLAC','created_at'=> Carbon::now()],
            ['establishment' => 'Sri Lanka Artillery','abbr' => 'SLA','created_at'=> Carbon::now()],
            ['establishment' => 'Sri Lanka Engineers','abbr' => 'SLE','created_at'=> Carbon::now()],
            ['establishment' => 'Sri Lanka Signal Corps','abbr' => 'SLSC','created_at'=> Carbon::now()],
            ['establishment' => 'Sri Lanka Light Infantry','abbr' => 'SLLI','created_at'=> Carbon::now()],
            ['establishment' => 'Sri Lanka Sinha Regiment','abbr' => 'SLSR','created_at'=> Carbon::now()],
            ['establishment' => 'Gamunu Watch','abbr' => 'GW','created_at'=> Carbon::now()],
            ['establishment' => 'Gajaba Regiment','abbr' => 'GR','created_at'=> Carbon::now()],
            ['establishment' => 'Vijayabahu Infantry Regiment','abbr' => 'VIR','created_at'=> Carbon::now()],
            ['establishment' => 'Mechanized Infantry Regiment','abbr' => 'Mech-Inf','created_at'=> Carbon::now()],
            ['establishment' => 'Commando Regiment','abbr' => 'CR','created_at'=> Carbon::now()],
            ['establishment' => 'Special Forces Regiment','abbr' => 'SF','created_at'=> Carbon::now()],
            ['establishment' => 'Military Intelligence Corps','abbr' => 'MIC','created_at'=> Carbon::now()],
            ['establishment' => 'Corps of Engineer Services','abbr' => 'CES','created_at'=> Carbon::now()],
            ['establishment' => 'Sri Lanka Army Service Corps','abbr' => 'SLASC','created_at'=> Carbon::now()],
            ['establishment' => 'Sri Lanka Army Medical Corps','abbr' => 'SLAMC','created_at'=> Carbon::now()],
            ['establishment' => 'Sri Lanka Army Ordnance Corps','abbr' => 'SLAOC','created_at'=> Carbon::now()],
            ['establishment' => 'Sri Lanka Electrical and Mechanical Engineers','abbr' => 'SLEME','created_at'=> Carbon::now()],
            ['establishment' => 'Sri Lanka Corps of Military Police','abbr' => 'SLCMP','created_at'=> Carbon::now()],
            ['establishment' => 'Sri Lanka Army GeneralService Corps','abbr' => 'SLAGSC','created_at'=> Carbon::now()],
            ['establishment' => 'Sri Lanka Army Womens Corps','abbr' => 'SLAWC','created_at'=> Carbon::now()],
            ['establishment' => 'Sri Lanka Rifle Corps','abbr' => 'SLRC','created_at'=> Carbon::now()],
            ['establishment' => 'Sri Lanka Army Pineer Corps','abbr' => 'SLAPC','created_at'=> Carbon::now()],
            ['establishment' => 'Sri Lanka National Guard','abbr' => 'SLNG','created_at'=> Carbon::now()],
            ['establishment' => 'Corps of Agriculture and Livestock','abbr' => 'CAL','created_at'=> Carbon::now()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('establishments');
    }
};

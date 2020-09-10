<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVillageStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('village_stats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('village_id')->unsigned();
            $table->foreign('village_id')->references('id')->on('villages')->onDelete('cascade');
            $table->string('village_name')->nullable();
            $table->integer('households_count')->nullable();
            $table->float('households_avgsize')->nullable();
            $table->integer('rom_households_count')->nullable();
            $table->float('rom_households_procent')->nullable();
            $table->integer('roms_count')->nullable();
            $table->integer('church_count');
            $table->integer('priest_count');
            $table->integer('deacon_count');
            $table->integer('singer_count');
            $table->integer('sexton_count');
            $table->integer('school_count');
            $table->integer('teacher_count');
            $table->integer('sdeacon_count');
            $table->integer('village_land');
            $table->integer('village_crops');
            $table->integer('villagesum_fruit');
            $table->integer('village_livestock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('village_stats');
    }
}

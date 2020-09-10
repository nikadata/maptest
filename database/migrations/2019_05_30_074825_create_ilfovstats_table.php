<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIlfovstatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ilfovstats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('village_id')->nullable();
            $table->string('village_name')->nullable();
            $table->string('subdistrict')->nullable();
            $table->integer('households')->nullable();
            $table->float('households_avg')->nullable();
            $table->integer('romhouseholds')->nullable();
            $table->decimal('romhouseholds_percent')->nullable();
            $table->integer('roms')->nullable();
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
        Schema::dropIfExists('ilfovstats');
    }
}

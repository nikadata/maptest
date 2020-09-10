<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wives', function (Blueprint $table) {
            $table->increments('id');
            $table->string('wife_name');
            $table->string('wife_status');
            $table->integer('wife_age');
            $table->string('wife_gender');
            $table->string('wife_nation')->nullable();
            $table->integer('household_id')->unsigned();
            $table->foreign('household_id')->references('id')->on('households');
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
        Schema::dropIfExists('wives');
    }
}

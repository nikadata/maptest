<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoresidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coresidents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('resident_cat');
            $table->string('resident_name');
            $table->string('resident_gender');
            $table->integer('resident_age');
            $table->string('resident_civil')->nullable();
            $table->string('resident_nation');
            $table->string('resident_class');
            $table->string('resident_job');
            $table->string('resident_second_job')->nullable();
            $table->string('resident_fiscal')->nullable();
            $table->string('resident_illness')->nullable();
            $table->string('resident_diagnosis_formal')->nullable();
            $table->string('resident_diagnosis_informal')->nullable();
            $table->integer('household_id')->unsigned();
            $table->foreign('household_id')->references('id')->on('households')->onDelete('cascade');
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
        Schema::dropIfExists('coresidents');
    }
}

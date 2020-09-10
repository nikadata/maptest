<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoresidentSpousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coresident_spouses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('coresident_id')->unsigned();
            $table->foreign('coresident_id')->references('id')->on('coresidents')->onDelete('cascade');
            $table->integer('household_id');
            $table->string('spouse_name');
            $table->string('spouse_gender');
            $table->integer('spouse_age');
            $table->string('spouse_nation');
            $table->string('spouse_job')->nullable();
            $table->string('spouse_illness')->nullable();
            $table->string('spouse_diagnosis_formal')->nullable();
            $table->string('spouse_diagnosis_informal')->nullable();
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
        Schema::dropIfExists('coresident_spouses');
    }
}

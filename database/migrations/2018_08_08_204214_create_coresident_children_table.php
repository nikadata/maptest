<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoresidentChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coresident_children', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('coresident_id')->unsigned();
            $table->foreign('coresident_id')->references('id')->on('coresidents')->onDelete('cascade');
            $table->integer('household_id');
            $table->string('child_name');
            $table->string('child_gender');
            $table->integer('child_age');
            $table->string('child_nation');
            $table->string('child_illness')->nullable();
            $table->string('child_diagnosis_formal')->nullable();
            $table->string('child_diagnosis_informal')->nullable();
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
        Schema::dropIfExists('coresident_children');
    }
}

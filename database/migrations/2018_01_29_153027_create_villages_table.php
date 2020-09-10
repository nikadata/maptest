<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVillagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('villages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('village_name');
            $table->string('comment')->nullable();
            $table->integer('households');
            $table->integer('people');
            $table->integer('gypsy');
            $table->integer('rudar');
            $table->integer('romanian');
            $table->integer('jewish');
            $table->integer('serbian');
            $table->integer('armenian')->nullable();
            $table->integer('ardelean')->nullable();
            $table->integer('german')->nullable();
            $table->integer('russian')->nullable();
            $table->integer('turk')->nullable();
            $table->integer('tax_payer');
            $table->integer('exempt_tax');
            $table->integer('landowner');
            $table->integer('renter');
            $table->integer('craftsman');
            $table->boolean('has_church');
            $table->boolean('has_priest');
            $table->boolean('has_deacon');
            $table->boolean('has_singer');
            $table->boolean('has_sexton');
            $table->boolean('has_school');
            $table->boolean('has_teacher');
            $table->boolean('has_sdeacon');
            $table->integer('physical');
            $table->integer('mental');
            $table->integer('disabilities');
            $table->integer('land');
            $table->integer('wheat');
            $table->integer('corn');
            $table->integer('fennel');
            $table->integer('barley');
            $table->integer('oats');
            $table->integer('millet');
            $table->integer('horses');
            $table->integer('bulls');
            $table->integer('cows');
            $table->integer('sheep');
            $table->integer('goats');
            $table->integer('pigs');
            $table->integer('buffalos');
            $table->integer('donkeys');
            $table->integer('mules');
            $table->integer('hives');
            $table->integer('fruittrees')->nullable();
            $table->integer('plumtrees');
            $table->integer('mulberrytrees');
            $table->integer('vineyards');
            $table->string('vineyardopt');
            $table->integer('apples');
            $table->integer('pears');
            $table->integer('nuts');
            $table->integer('cherries');
            $table->integer('sourcherries');
            $table->integer('county_id')->unsigned();
            $table->foreign('county_id')->references('id')->on('counties')->onDelete('cascade');
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
        Schema::dropIfExists('villages');
    }
}

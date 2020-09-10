<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /*
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('last_name');
            $table->integer('age');
            $table->string('maritalstatus');
            $table->string('nationality');
            $table->string('taxpayer');
            $table->integer('village_id')->unsigned();
            $table->foreign('village_id')->references('id')->on('villages')->onDelete('cascade');
            $table->integer('socialclass_id')->unsigned();
            $table->foreign('socialclass_id')->references('id')->on('social_classes')->onDelete('cascade');
            $table->integer('skill_id')->unsigned();
            $table->foreign('skill_id')->references('id')->on('skills');
            $table->integer('source_id')->unsigned();
            $table->foreign('source_id')->references('id')->on('sources');
            $table->timestamps();
        });
    }
*/
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgePyramidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('age_pyramids', function (Blueprint $table) {
            $table->increments('id');
            $table->string('age')->nullable();
            $table->integer('male')->nullable();
            $table->integer('female')->nullable();
            $table->integer('ilfov_male')->nullable();
            $table->integer('ilfov_female')->nullable();
            $table->integer('dambovita_male')->nullable();
            $table->integer('dambovita_female')->nullable();
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
        Schema::dropIfExists('age_pyramids');
    }
}

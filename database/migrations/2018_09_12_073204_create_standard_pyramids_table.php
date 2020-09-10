<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStandardPyramidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('standard_pyramids', function (Blueprint $table) {
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
        Schema::dropIfExists('standard_pyramids');
    }
}

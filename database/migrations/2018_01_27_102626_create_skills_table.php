<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->increments('id');
            $table->string('skill_name');
            $table->string('skill_description');
            $table->integer('roms_count')->nullable()->default('0');
            $table->integer('second_roms_count')->nullable()->default('0');
            $table->integer('ilfov_roms_count')->nullable()->default('0');
            $table->integer('ilfov_second_roms_count')->nullable()->default('0');
            $table->integer('dambovita_roms_count')->nullable()->default('0');
            $table->integer('dambovita_second_roms_count')->nullable()->default('0');
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
        Schema::dropIfExists('skills');
    }
}

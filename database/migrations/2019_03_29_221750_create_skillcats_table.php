<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillcatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skillcats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('skillcat_name')->nullable();
            $table->integer('skillcat_number')->nullable();
            $table->decimal('skillcat_pr')->nullable();
            $table->integer('ilfov_skillcat_number')->nullable();
            $table->decimal('ilfov_skillcat_pr')->nullable();
            $table->integer('dambovita_skillcat_number')->nullable();
            $table->decimal('dambovita_skillcat_pr')->nullable();
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
        Schema::dropIfExists('skillcats');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseholdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('households', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number');
            $table->string('name');
            $table->string('fname');
            $table->string('surname')->nullable();
            $table->string('nickname')->nullable();
            $table->string('gender');
            $table->string('family')->nullable();
            $table->integer('age');
            $table->string('civilstatus');
            $table->boolean('wife');
            $table->boolean('children');
            $table->boolean('coresident')->nullable();
            $table->boolean('coresident_spouse')->nullable();
            $table->boolean('coresident_child')->nullable();
            $table->boolean('linked');
            $table->integer('extended_id')->unsigned();
            $table->foreign('extended_id')->references('id')->on('extendeds')->onDelete('cascade');
            $table->string('nationality');
            $table->string('fiscal');
            $table->string('fiscalcomment')->nullable();
            $table->integer('socialclass_id')->unsigned();
            $table->foreign('socialclass_id')->references('id')->on('social_classes')->onDelete('cascade');
            $table->integer('skill_id')->unsigned();
            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
            $table->integer('second_skill_id')->unsigned()->nullable();
            $table->foreign('second_skill_id')->references('id')->on('skills')->onDelete('cascade');
            $table->integer('land');
            $table->string('diagnosis')->nullable();
            $table->string('inf_diagnosis')->nullable();
            $table->integer('wheat');
            $table->integer('corn');
            $table->integer('fennel');
            $table->integer('barley');
            $table->integer('oats');
            $table->integer('millet');
            $table->string('illness');
            $table->string('servant');
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
            $table->mediumText('comment')->nullable();
            $table->integer('village_id')->unsigned();
            $table->foreign('village_id')->references('id')->on('villages')->onDelete('cascade');
            $table->integer('source_id')->unsigned()->nullable();
            $table->foreign('source_id')->references('id')->on('sources');
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
        Schema::dropIfExists('households');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreningPlan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trening_plan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('naziv');
            $table->integer('plan_tip_id')->unsigned()->notnull();
            $table->integer('broj_sedmica');
            $table->boolean('vidljiv');
            $table->string('nivo');
            $table->string('opis');
            $table->foreign('plan_tip_id')->references('id')->on('plan_tip');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trening_plan');
    }
}

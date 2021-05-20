<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreningPlanTrening extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trening_plan_trening', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trening_plan_id')->unsigned();
            $table->integer('sedmica');
            $table->integer('dan');
            $table->integer('broj_kilometara')->nullable();
            $table->string('opis');
            $table->string('tip');
            $table->foreign('trening_plan_id')->references('id')->on('trening_plan');
            $table->timestamps();
            $table->unique(['sedmica','dan']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trening_plan_trening');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTreningPlanTrening extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_trening_plan_trening', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('korisnik_trening_plan_id')->unsigned();
            $table->date('datum');
            $table->integer('trening_plan_trening_id')->unsigned();
            $table->string('status')->nullable();
            $table->string('opis')->nullable();
            $table->integer('broj_km')->nullable();
            $table->timestamps();
            $table->foreign('korisnik_trening_plan_id')->references('id')->on('trening_plan');
            $table->foreign('trening_plan_trening_id')->references('id')->on('trening_plan_trening');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_trening_plan_trening');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTreningPlan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_trening_plan', function (Blueprint $table) {
            $table->increments('id');
            $table->date('datum');
            $table->integer('user_id')->unsigned();
            $table->integer('trening_plan_id');
            $table->string('status');
            $table->timestamps();
            $table->foreign('user_id')->references('user')->on('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_trening_plan');
    }
}

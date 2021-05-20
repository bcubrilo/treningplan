<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email',100)->unique();
            $table->string('password');
            $table->date('datum_rodjenja')->nullable();
            $table->string('nacin_obavjestavanja');
            $table->string('viber_code');
            $table->boolean('verifikovan');
            $table->string('nacin_obavjestavanja');
            $table->int('sat_obavjestenja');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}

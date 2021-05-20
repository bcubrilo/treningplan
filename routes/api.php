<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});

    Route::get('/dashboard/plan-tip/view/{id?}','Dashboard\PlanTipController@view');
    Route::post('/dashboard/plan-tip/save','Dashboard\PlanTipController@save');
    Route::get('/dashboard/plan-tip/delete/{id}','Dashboard\PlanTipController@delete');

    Route::get('/dashboard/trening-plan/view/{id?}','Dashboard\TreningPlanController@view');
    Route::post('/dashboard/trening-plan/save','Dashboard\TreningPlanController@save');
    Route::get('/dashboard/trening-plan/delete/{id}','Dashboard\TreningPlanController@delete');
    Route::post('/dashboard/trening-plan/sacuvaj-trening','Dashboard\TreningPlanController@sacuvajTrening');
    Route::get('/dashboard/trening-plan/delete-trening/{id}','Dashboard\TreningPlanController@deleteTrening');
    Route::get('/dashboard/trening-plan/filter-tip/{id}','Dashboard\TreningPlanController@filterByTip');

    Route::post('/korisnik/kreiraj-plan','KorisnikTreningPlanController@kreirajTreningPlan');
    Route::get('/korisnik/planovi/{status?}','KorisnikTreningPlanController@sviPlanovi');
    Route::get('/korisnik/plan/{id}','KorisnikTreningPlanController@ucitajPlan');
    Route::post('/korisnik/plan/sacuvaj-trening','KorisnikTreningPlanController@sacuvajTrening');
    Route::post('/korisnik/plan/promijeni-datum-pocetka','KorisnikTreningPlanController@promijeniDatumPocetka');
    Route::get('/korisnik/plan/otkazi-plan/{id}','KorisnikTreningPlanController@otkaziPlan');

    Route::get('/korisnik/profil','KorisnikController@getUserInfo');
    Route::post('/korisnik/azuriraj','KorisnikController@updateInfo');
    Route::get('/korisnik/broj-telefona-posalji-kod','KorisnikController@posaljiKodZaVerifikacijuTelefona');
    Route::post('/korisnik/promijeni-lozinku','KorisnikController@promijeniLozinku');




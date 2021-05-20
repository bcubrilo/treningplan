<?php
Auth::routes();

Route::get('/', function () {
  return view('index');
})->name('pocetna');

Route::get('/home', function () {
  return view('home');
});

Route::get('/dashboard', function () {
  return view('dashboard');
})->name('dashboard')->middleware('auth','admin');

Route::middleware(['cors','auth'])->group(function () {

  Route::post('/korisnik/kreiraj-plan','KorisnikTreningPlanController@kreirajTreningPlan');
  Route::get('/korisnik/planovi/{status?}','KorisnikTreningPlanController@sviPlanovi');
  Route::get('/korisnik/plan/{id}','KorisnikTreningPlanController@ucitajPlan');
  Route::post('/korisnik/plan/sacuvaj-trening','KorisnikTreningPlanController@sacuvajTrening');
  Route::post('/korisnik/plan/promijeni-datum-pocetka','KorisnikTreningPlanController@promijeniDatumPocetka');
  Route::get('/korisnik/plan/otkazi-plan/{id}','KorisnikTreningPlanController@otkaziPlan');
  Route::get('/korisnik/plan/trening/{korisnikPlanId}/{treningId}','KorisnikTreningPlanController@getTrening');


  Route::get('/korisnik/profil','KorisnikController@getUserInfo')->middleware('auth','cors');
  Route::post('/korisnik/azuriraj','KorisnikController@updateInfo');
  Route::get('/korisnik/broj-telefona-posalji-kod','KorisnikController@posaljiKodZaVerifikacijuTelefona');
  Route::post('/korisnik/promijeni-lozinku','KorisnikController@promijeniLozinku');

  Route::post('/korisnik/izloguj-korisnika','KorisnikController@izlogujKorisnika');

  Route::get('/posalji-obavjestenje','KorisnikController@treningPosaljiObavjestenje');
  Route::get('/dashboard/plan-tip/view/{id?}/{vidljiv?}', 'Dashboard\PlanTipController@view');
  Route::get('/dashboard/trening-plan/filter-tip/{id}', 'Dashboard\TreningPlanController@filterByTip');
  Route::get('/dashboard/trening-plan/view/{id?}', 'Dashboard\TreningPlanController@view');

  Route::get('/app',function () {
    return view('app');
  })->name('app')->middleware('auth');
});

Route::middleware(['cors','admin','auth'])->group(function () {
  Route::post('/dashboard/plan-tip/save', 'Dashboard\PlanTipController@save');
  Route::get('/dashboard/plan-tip/delete/{id}', 'Dashboard\PlanTipController@delete');


  Route::post('/dashboard/trening-plan/save', 'Dashboard\TreningPlanController@save');
  Route::get('/dashboard/trening-plan/delete/{id}', 'Dashboard\TreningPlanController@delete');
  Route::post('/dashboard/trening-plan/sacuvaj-trening', 'Dashboard\TreningPlanController@sacuvajTrening');
  Route::get('/dashboard/trening-plan/delete-trening/{id}', 'Dashboard\TreningPlanController@deleteTrening');
  Route::post('/dashboard/trening-plan/sacuvaj-sedmicne-treninge', 'Dashboard\TreningPlanController@sacuvajSedmicneTreninge');
  Route::get('/dashboard/korisnici', 'Dashboard\KorisniciController@view');
});

Route::get('/zavrsi-registraciju/{token}', 'Auth\RegisterController@confirm');


Route::get('/clear-cache', function() {
  $exitCode = Artisan::call('cache:clear');
  $exitCode = Artisan::call('view:clear');
  // return what you want
});
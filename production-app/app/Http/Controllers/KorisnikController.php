<?php

namespace App\Http\Controllers;

use App\Model\TreningPlan;
use App\Model\TreningPlanTrening;
use App\Model\UserTreningPlanTrening;
use Carbon\Carbon;
use function foo\func;
use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\KorisnikTreningObavjestenje;
use Illuminate\Support\Facades\Mail;

class KorisnikController extends Controller
{
    public function getUserInfo(){
        $user = Auth::user();

        $userInfo = new \stdClass();
        if($user != null) {
            $userInfo->email = $user->email;
            $userInfo->broj_telefona = $user->broj_telefona != null ? $user->broj_telefona : '';
            $userInfo->nacin_obavjestavanja = $user->nacin_obavjestavanja != null ? $user->nacin_obavjestavanja : '';
            $userInfo->posalji_obavjestenje = $user->posalji_obavjestenje;
            $userInfo->sat_obavjestenja = $user->sat_obavjestenja;
        }
        return response(['user_info'=>$userInfo])
            ->header('Access-Control-Allow-Origin', 'treningplan.trcizdravo.com')// maybe put this into the .env file so you can change the URL in production.
            ->header('Access-Control-Allow-Methods', '*')// or specify `'GET, POST, PUT, DELETE'` etc as the second parameter if you want to restrict the methods that are allowed.
            ->header('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Authorization');
    }
    public function updateInfo(Request $request){
        $email = $request->input('email');
        $brojTelefona = $request->input('broj_telefona');
        $nacinObavjestavanja = $request->input('nacin_obavjestavanja');

        $user = Auth::user();

        if(strcasecmp ($user->broj_telefona,$brojTelefona)<>0){
            if(strcmp($request->input('broj_telefona_verifikacija_kod'),$user->novi_broj_telefona_token)==0) {
                $user->broj_telefona = $brojTelefona;
            }
        }
        if(strcasecmp($user->nacin_obavjestavanja,$nacinObavjestavanja)<>0){
            $user->nacin_obavjestavanja = $nacinObavjestavanja;
        }

        $user->posalji_obavjestenje = $request->input('posalji_obavjestenje');

        if($user->sat_obavjestenja <> intval($request->input('sat_obavjestenja'))){
            $user->sat_obavjestenja = $request->input('sat_obavjestenja');
        }

        $user->save();
        response('OK',200);

    }

    public function posaljiKodZaVerifikacijuTelefona(){
        $user = Auth::user();
        $user->novi_broj_telefona_token = str_random(5);
        $user->save();
    }

    public function promijeniLozinku(Request $request){
        $user = Auth::user();
        $staraLozinka = $request->input('stara_lozinka');

        $status = new \stdClass();
        $status->poruka = '';
        $status->error = false;

        if(!Hash::check($staraLozinka, $user->password)){
            $status->poruka = 'Niste unijeli ispravnu lozinku!';
            $status->error = true;
        }

            $novaLozinka = $request->input('nova_lozinka');
            $potvrdaLozinke = $request->input('nova_lozinka_potvrda');
            if (strlen($novaLozinka) < 6) {
                $status->poruka = 'Šifra mora da ima najmanje 6 karaktera!';
                $status->error = true;
            }
            if(strcmp($novaLozinka,$potvrdaLozinke)<>0){
                $status->poruka = 'Morate da potvrdite lozinku!';
                $status->error = true;
            }
            $cryptNovaLozinka = bcrypt($novaLozinka);
            if (strcmp($user->password, $cryptNovaLozinka)==0) {
                $status->poruka = 'Morate unijeti novu lozinku!!';
                $status->error = true;
            }
            if(!$status->error){
                $user->password = $cryptNovaLozinka;
                $user->save();
                $status->poruka = 'Lozinka je promijenjena.';
                $status->error = false;
            }

        return [$status];
    }
    public function izlogujKorisnika(){
      Auth::logout();
    }

}

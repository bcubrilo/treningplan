<?php

namespace App\Http\Controllers;

use App\Model\TreningPlan;
use App\Model\TreningPlanTrening;
use App\Model\UserTreningPlan;
use App\Model\UserTreningPlanTrening;
use Illuminate\Http\Request;
use DateTime;
use App\Model\User;
use DB;
use Illuminate\Support\Facades\Auth;
class KorisnikTreningPlanController extends Controller
{
    public function kreirajTreningPlan(Request $request){
        $user = Auth::user();
        $planId = $request->input('plan_id');
        $plan = TreningPlan::findOrFail($planId);
        $datumPocetka =  DateTime::createFromFormat('Y-m-d',$request->input('datum'));
        $korisnikPlan = null;
        if($plan){

            $korisnikPlan = new UserTreningPlan();
            $korisnikPlan->trening_plan_id = $planId;
            $korisnikPlan->datum = $datumPocetka;
            $korisnikPlan->user_id = $user->id;
            $korisnikPlan->status = 'A';
            $status = $korisnikPlan->save();

            $datum = $datumPocetka;
            if ($status) {
                foreach ($plan->treninzi as $trening) {
                    $datum = date_create($request->input('datum'));
                    $brojDana = ($trening->sedmica - 1) * 7 + ($trening->dan - 1);
                    $datum = date_add($datum, date_interval_create_from_date_string($brojDana . ' days'));
                    $korisnikTrening = new UserTreningPlanTrening();
                    $korisnikTrening->datum = $datum;
                    $korisnikTrening->korisnik_trening_plan_id = $korisnikPlan->id;
                    $korisnikTrening->trening_plan_trening_id = $trening->id;
                    $korisnikTrening->save();

                }
                response('OK', 200);
            }

        }
        response('Došlo je do greške',500);
    }

    public function sviPlanovi($status){
        $user = Auth::user();
        $returnData=[];
        $planovi = UserTreningPlan::where('user_id',$user->id)->where('status',$status)->get();
        if(count($planovi)){
            foreach ($planovi as $plan){
                $tmp = new \stdClass();
                $tmp->korisnik_plan=$plan;
                $tmp->trening_plan=$plan->trening_plan;
                $tmp->tip = $plan->trening_plan->tip;
                $returnData[]=$tmp;
            }
        }
        return $returnData;
    }
    public function ucitajPlan($id){
        $user = Auth::user();
        $plan = UserTreningPlan::where('user_id',$user->id)->where('id',$id)->get();
        $planInfo = new \stdClass();
        if($plan){
            $plan = $plan[0];
            $planInfo->korisnik_plan = $plan;
            $planInfo->trening_plan = $plan->trening_plan;
            $planInfo->trening = ['treninzi'=>$plan->treninzi,'plan_treninzi'=>$plan->trening_plan->treninzi];
        }
        return [$planInfo];
    }
    public function sacuvajTrening(Request $request){

        $plan_id = $request->input('plan_id');
        $trening_id = $request->input('trening_id');

        $user = Auth::user();
        $userTreningPlan = UserTreningPlan::where('id',$plan_id)->where('user_id',$user->id)->get();
        $userTreningPlan = $userTreningPlan[0];
        $trening = UserTreningPlanTrening::where('korisnik_trening_plan_id', $userTreningPlan->id)
            ->where('id', $trening_id)
            ->get();
        if ($trening) {
            $trening = $trening[0];
            $trening->status = $request->input('status');
            $trening->broj_km = $request->input('broj_km');
            $trening->opis = $request->input('opis');
            $status = $trening->save();
            if ($status) {
                response('OK', 200);
            }
        }

        response('Došlo je do greške',500);
    }
    public function promijeniDatumPocetka(Request $request){

        $plan_id = $request->input('plan_id');
        $novi_datum = $request->input('novi_datum');
        $greske = [];
        $user = Auth::user();
        $plan = UserTreningPlan::where('user_id',$user->id)->where('id',$plan_id)->first();
        $noviDatum = DateTime::createFromFormat('Y-m-d',$novi_datum);
        date_add($noviDatum, date_interval_create_from_date_string(($plan->broj_sedmica * 7) . ' days'));
        $plan->datum = DateTime::createFromFormat('Y-m-d',$novi_datum);
        $plan->save();

        foreach ($plan->treninzi as $tr){
            $trening = UserTreningPlanTrening::where('id',$tr->id)->first();
            $planTrening = TreningPlanTrening::where('id',$tr->trening_plan_trening_id)->first();

            $datum =DateTime::createFromFormat('Y-m-d',$novi_datum);
            $brojDana = ($planTrening->sedmica - 1) * 7 + ($planTrening->dan - 1);

            date_add($datum, date_interval_create_from_date_string($brojDana . ' days'));

            $trening->datum = $datum;
            $trening->save();

        }
        response('OK!',200);
    }
    public function otkaziPlan($id){
        $user = Auth::user();
        $plan = UserTreningPlan::where('id',$id)->where('user_id',$user->id)->first();
        $plan->status = 'O';
        $plan->save();
        response('OK',200);
    }

    public function getTrening($korisnikPlanId,$treningId){
      $user = Auth::user();
      $plan = UserTreningPlan::with('trening_plan')->where('user_id',$user->id)->where('id',$korisnikPlanId)->get();

      $planInfo = new \stdClass();
      if($plan){
        $plan = $plan[0];
        $trening = $plan->treninzi()->with('trening_plan_trening')->where('id',$treningId)->first();
        $planInfo->korisnik_plan = $plan;
        $planInfo->trening = $trening;

      }
      return [$planInfo];
    }
}

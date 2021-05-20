<?php

namespace App\Http\Controllers\Dashboard;

use App\Model\PlanTip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanTipController extends Controller
{
    public function view($id = false){
        $tipovi = null;
        if($id){
            $tipovi = PlanTip::findOrFail($id);
        }else{
            $tipovi = PlanTip::all();
        }
        return $tipovi;
    }
    public function save(Request $request){
        $id = intval($request->input('id'));
        $tip = null;
        if($id>0){
            $tip = PlanTip::findOrFail($id);

        }else{
            $tip = new PlanTip();
        }
        if($tip){
            $tip->naziv = $request->input('naziv');
        }

        $tip->save();
    }
    public function delete($id){
        PlanTip::where('id',$id)->delete();
        response('Obrisano',200);
    }

}

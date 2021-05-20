<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserTreningPlanTrening extends Model
{
    protected $table='user_trening_plan_trening';
    public $timestamps = false;
    protected $fillable = [
        'datum'
        ,'korisnik_trening_plan_id'
        ,'trening_plan_trening_id'
        ,'status'
        ,'opis'
        ,'broj_km'
        ,'zavrsen'
    ];
    public function trening_plan_trening(){
        return $this->belongsTo('App\Model\TreningPlanTrening','trening_plan_trening_id');
    }

}

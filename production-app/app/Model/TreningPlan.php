<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TreningPlan extends Model
{
    public $timestamps = false;
    protected $table = 'trening_plan';
    protected $fillable =['naziv',	'plan_tip_id',	'broj_sedmica',	'nivo','opis'];

    public function tip(){
        return $this->belongsTo('App\Model\PlanTip','plan_tip_id');
    }
    public function treninzi(){
        return $this->hasMany('App\Model\TreningPlanTrening','trening_plan_id');
    }
}

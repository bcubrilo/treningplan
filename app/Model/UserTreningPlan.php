<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserTreningPlan extends Model
{
    protected $table ='user_trening_plan';
    protected $fillable = ['datum','trening_plan_id','user_id','status'];

    public function treninzi(){
        return $this->hasMany('App\Model\UserTreningPlanTrening','korisnik_trening_plan_id');
    }
    public function trening_plan(){
        return $this->belongsTo('App\Model\TreningPlan','trening_plan_id');
    }


}

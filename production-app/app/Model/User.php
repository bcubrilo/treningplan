<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table='users';
    protected $fillable=[
         'name'
        ,'email'
        ,'password'
        ,'broj_telefona'
        ,'nacin_obavjestavanja'
        ,'grupa_korisnika'
        ,'verifikovan'
        ,'verifikacioni_kod'
        ,'verifikacioni_kod_datum'
        ,'posalji_obavjestenje'
    ];

    public function planovi(){
        return $this->hasMany('App\Model\UserTreningPlan','user_id');
    }
    public function treninzi(){
        return $this->hasManyThrough(
            'App\Model\UserTreningPlanTrening',
            'App\Model\UserTreningPlan',
            'user_id',
            'korisnik_trening_plan_id')
            ;
    }
}

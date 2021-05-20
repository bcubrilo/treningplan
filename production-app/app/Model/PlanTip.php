<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PlanTip extends Model
{
    public $timestamps = false;
    protected $fillable =[
        'naziv',
        'vidljiv'
    ];
    protected $table = 'plan_tip';
}

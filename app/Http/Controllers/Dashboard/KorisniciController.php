<?php

namespace App\Http\Controllers\Dashboard;

use App\Model\PlanTip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
class KorisniciController extends Controller
{
  public function view($id = false){
    $korisnici = User::all();
    return $korisnici;
  }
}
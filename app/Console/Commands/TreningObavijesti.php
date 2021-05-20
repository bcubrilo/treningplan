<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\User;
use Carbon\Carbon;
use App\Model\TreningPlanTrening;
use App\Model\TreningPlan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\KorisnikTreningObavjestenje;
use Mockery\Exception;

class TreningObavijesti extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trening:obavijesti';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Posalji korisniku obavijest o treningu';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $danas = Carbon::now('Europe/Belgrade');
        $korisnici = DB::table('users')
            ->join('user_trening_plan','users.id','=','user_trening_plan.user_id')
            ->join('user_trening_plan_trening','user_trening_plan.id','=','user_trening_plan_trening.korisnik_trening_plan_id')
            ->join('trening_plan_trening','trening_plan_trening.id','=','user_trening_plan_trening.trening_plan_trening_id')
            ->where('users.posalji_obavjestenje','=',1)
            ->where('users.sat_obavjestenja','=',$danas->hour)
            ->where('user_trening_plan_trening.datum','=',$danas->toDateString())
            ->where('trening_plan_trening.tip','not like','Odmor')
            ->where('user_trening_plan_trening.status','=',null)
            ->select('users.id')
            ->groupBy('users.id')
            ->get();

        $data= DB::table('users')
            ->join('user_trening_plan','users.id','=','user_trening_plan.user_id')
            ->join('user_trening_plan_trening','user_trening_plan.id','=','user_trening_plan_trening.korisnik_trening_plan_id')
            ->join('trening_plan','trening_plan.id','=','user_trening_plan.trening_plan_id')
            ->join('trening_plan_trening','trening_plan_trening.id','=','user_trening_plan_trening.trening_plan_trening_id')
            ->where('users.posalji_obavjestenje','=',1)
            ->where('users.sat_obavjestenja','=',$danas->hour)
            ->where('user_trening_plan_trening.datum','=',$danas->toDateString())
            ->where('trening_plan_trening.tip','not like','Odmor')
            ->where('user_trening_plan_trening.status','=',null)
            ->select(
                'users.id as user_id'
                ,'trening_plan.id as plan_id'
                ,'trening_plan.naziv as plan_naziv'
                ,'trening_plan_trening.opis as trening_opis'
            )
            ->get();

        foreach ($korisnici as $korisnik) {
            $podaci = [];

            $treninzi = $data->filter(function ($row) use($korisnik)
            {
                return $row->user_id == $korisnik->id;
            });

            foreach ($treninzi as $trening) {

                $podaci[]=[
                    'opis'=>$trening->trening_opis,
                    'naziv_plana'=>$trening->plan_naziv,
                    'plan_id'=>$trening->plan_id
                ];
            }


            Mail::to(User::findOrFail($korisnik->id))->send(new KorisnikTreningObavjestenje($podaci));
        }

    }
}

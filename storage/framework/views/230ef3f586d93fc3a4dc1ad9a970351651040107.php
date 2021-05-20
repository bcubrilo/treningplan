<html>

</html>
<body>
    <?php
    $danas = Carbon\Carbon::now('CET');
    $query = DB::table('users')
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
        );
    dd($query->toSql());

    ?>
</body>
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trenig::Trci Zdravo</title>
</head>
<body>
    <h1>Danas imate trening</h1>
   @foreach($podaci as $trening)
       <div>


           <p>{{$trening['opis']}}</p>
           <div>
               <a href="https://www.treningplan.trcizdravo.com/#/plan/{{$trening['plan_id']}}">
                   https://www.treningplan.trcizdravo.com/#/plan/{{$trening['plan_id']}}
               </a>
           </div>
       </div>
       @endforeach

</body>
</html>

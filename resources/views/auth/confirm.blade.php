<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{asset('css/home.app.css')}}"/>
</head>
<body>
<div class="login-page">

    <div class="form" >
        <p>Vaš nalog je verifikovan. Sada možete da se logujete.</p>
        <a href="{{URL::to('/login')}}"><button>Login</button></a>
    </div>
</div>


</body>
</html>

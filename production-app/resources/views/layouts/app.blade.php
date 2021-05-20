<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-96195546-3"></script>

    <title>Trening plan</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">


    <meta name="description" content="Ovdje možete pronaći idealan trening plan za vašu narednu trku. Odaberite svoj plan,
        mi ćemo vam svakog dana kada imate trening poslati email sa instrukcijama. Takođe, nudimo vam mogućnost vođenja vašeg trkačkog dnevnika."/>

    <meta name="keywords" content="trening plan maraton polumaraton 10 trcanje sport rekreacija trening program"/>
    <meta name="title" content="Trcanje plan treninga za maraton, polumaraton"/>
    <meta property="og:image" content="{{asset('images/login.jpg')}}">
    <meta name="twitter:image" content="{{asset('images/login.jpg')}}">

    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-8787290704403325",
            enable_page_level_ads: true
        });
    </script>
    @if(\Illuminate\Support\Facades\Auth::check())
    <link rel="stylesheet" href="{{asset('css/vuetify.min.css')}}"/>
        @else
        <link rel="stylesheet" href="{{asset('css/home.app.css')}}"/>
    @endif
</head>
<body>

<style>

</style>
<div>
    @if(!\Illuminate\Support\Facades\Auth::check())
    <img class="strips" src="{{asset('images/strips.png')}}">
        @endif
</div>
    <div id="app">
        @yield('content')
    </div>

</body>
</html>

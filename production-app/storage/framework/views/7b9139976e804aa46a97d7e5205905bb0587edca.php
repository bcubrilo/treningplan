<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>


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
    <meta property="og:image" content="<?php echo e(asset('images/login.jpg')); ?>">
    <meta name="twitter:image" content="<?php echo e(asset('images/login.jpg')); ?>">

    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-8787290704403325",
            enable_page_level_ads: true
        });
    </script>
    <?php if(\Illuminate\Support\Facades\Auth::check()): ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/vuetify.min.css')); ?>"/>
        <?php else: ?>
        <link rel="stylesheet" href="<?php echo e(asset('css/home.app.css')); ?>"/>
    <?php endif; ?>
</head>
<body>

<style>

</style>
<div>
    <?php if(!\Illuminate\Support\Facades\Auth::check()): ?>
    <img class="strips" src="<?php echo e(asset('images/strips.png')); ?>">
        <?php endif; ?>
</div>
    <div id="app">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

</body>
</html>

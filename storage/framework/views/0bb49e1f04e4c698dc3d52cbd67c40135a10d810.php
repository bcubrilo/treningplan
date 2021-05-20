<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('css/home.app.css')); ?>"/>
</head>
<body>
<div class="login-page">

    <div class="form" >
        <p>Vaš nalog je verifikovan. Sada možete da se logujete.</p>
        <a href="<?php echo e(URL::to('/login')); ?>"><button>Login</button></a>
    </div>
</div>


</body>
</html>

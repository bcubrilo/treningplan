<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('css/home.app.css')); ?>"/>
</head>
<body>

<style>

</style>
<div>
    <img class="strips" src="<?php echo e(asset('images/strips.png')); ?>">
</div>
    <div id="app">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

</body>
</html>

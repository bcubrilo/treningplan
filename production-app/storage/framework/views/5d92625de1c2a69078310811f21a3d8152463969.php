<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trenig::Trci Zdravo</title>
</head>
<body>
    <h1>Danas imate trening</h1>
   <?php $__currentLoopData = $podaci; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trening): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       <div>


           <p><?php echo e($trening['opis']); ?></p>
           <div>
               <a href="<?php echo e(URL::to('/')); ?>/#/plan/<?php echo e($trening['plan_id']); ?>">
                   <?php echo e(URL::to('/')); ?>/#/plan/<?php echo e($trening['plan_id']); ?>

               </a>
           </div>
       </div>
       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</body>
</html>

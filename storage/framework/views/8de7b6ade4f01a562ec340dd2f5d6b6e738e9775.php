<?php $__env->startSection('content'); ?>
    <div>
        <div id=app>
            <full></full>

        </div>


    </div>
    <script src="<?php echo e(mix('/js/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
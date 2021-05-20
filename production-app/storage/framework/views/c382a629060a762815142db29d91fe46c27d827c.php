<?php $__env->startSection('content'); ?>
    <div class="login-page">

        <div class="form" >
            <form class="form-horizontal" method="POST" action="<?php echo e(route('register')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                            <div class="col-md-6">
                                <input id="name" type="text" placeholder="Korisničko Ime" name="name" value="<?php echo e(old('name')); ?>" required autofocus>

                                <?php if($errors->has('name')): ?>
                                    <span class="help-block">
                                        <p class="message"><?php echo e($errors->first('name')); ?></p>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <div class="col-md-6">
                                <input id="email" type="email" placeholder="E-Mail Adresa" name="email" value="<?php echo e(old('email')); ?>" required>

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <p class="message"><?php echo e($errors->first('email')); ?></p>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <div class="col-md-6">
                                <input id="password" type="password" placeholder="Lozinka" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <p class="message"><?php echo e($errors->first('password')); ?></p>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6">
                                <input id="password-confirm" type="password"  name="password_confirmation" required placeholder="Potvrdite lozinku">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Registruj se
                                </button>
                            </div>
                        </div>
                    </form>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>

    <div class="login-page">

        <div class="form" >
            <p style="display:none;" class="message" <?php if($errors->has('email') || $errors->has('password')): ?> <?php echo e('has-error'); ?> <?php endif; ?>>Logovanje nije uspjelo!</p>
            <form method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo e(csrf_field()); ?>


                <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                    <div>
                        <input id="email" type="email" placeholder="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus>
                    </div>
                </div>

                <div class="<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                    <div>
                        <input id="password" type="password" placeholder="lozinka" name="password" required>

                    </div>
                </div>

                <div>
                    <label>
                        <input style="max-width: 10px;text-align: left" type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> Zapamti Me
                    </label>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Login
                        </button>

                        <a class="message" href="<?php echo e(route('password.request')); ?>">
                            Zaboravili ste lozinku?
                        </a>
                    </div>
                </div>
                <div>
                    <p class="message">Niste registrovani? <a href="<?php echo e(route('register')); ?>">Napravite nalog</a></p>
                </div>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
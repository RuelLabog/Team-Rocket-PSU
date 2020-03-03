<?php $__env->startSection('content'); ?>

<div class="container h-100">
    <div class="d-flex justify-content-center h-100">
        <div class="user_card">
            <div class="d-flex justify-content-center">
                <div class="brand_logo_container">
                    <img src="https://i.pinimg.com/originals/0e/e5/89/0ee58946f8b3832204d39c0b429d8d9a.gif" class="brand_logo" alt="Logo" width="250 px">

                <!-- <video id="video"   playsinline="" muted="" autoplay="" loop="" data-silent="true" src="https://cdn.dribbble.com/users/418188/screenshots/3102257/rocket_animation_tubik_studio.gif?vid=1"></video> -->
                </div>

            </div>
            <div class="d-flex justify-content-center form_container">


                <form method="POST" action="<?php echo e(route('login')); ?>" aria-label="<?php echo e(__('Login')); ?>">

                <?php echo csrf_field(); ?>
                    <div class="" style="text-align: center;">
                        <h1>Team Rocket</h1>
                    </div>
                    <Br>
                    <div class="input-group mb-3">
                        <div class="input-group-append" >
                            <span class="input-group-text" style="background-color: #42b6f5; color:white"><i class="fas fa-user"></i></span>
                        </div>
                        <input id="login" type="text"
                                class="input_user form-control<?php echo e($errors->has('username') || $errors->has('email') ? ' is-invalid' : ''); ?>"
                                name="login" value="<?php echo e(old('username') ?: old('email')); ?>"
                                placeholder="Email" required autofocus>

                        <?php if($errors->has('username') || $errors->has('email')): ?>
                        <span class="invalid-feedback">
                        <strong><?php echo e($errors->first('username') ?: $errors->first('email')); ?></strong>
                         </span>
                        <?php endif; ?>

                        <!-- <input type="text"
                        id="username"
                        placeholder="Enter username"
                        ng-model="data.loginUsername"
                        class="form-control input_user"
                        placeholder="username"> -->
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-append">
                            <span class="input-group-text" style="background-color: #42b6f5; color:white"><i class="fas fa-key"></i></span>
                        </div>
                        <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="password" required autocomplete="current-password"
                                placeholder="Password">

                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <!-- <input type="password" name="" class="form-control input_pass"
                        id="login-password"
                        placeholder="Enter password"
                        ng-model="data.loginPassword"
                        placeholder="password"> -->
                    </div>

                        <div class="d-flex justify-content-center mt-3 login_container">

                <button type="submit" name="button" class="btn login_btn" style="width: 100%">Login</button>

               </div>
                </form>
            </div>


        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\NMS-Inventory-System\Team-Rocket-PSU\LoopSystem\resources\views/auth/login.blade.php ENDPATH**/ ?>
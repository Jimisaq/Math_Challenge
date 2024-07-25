

<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="section-image">
                <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
                <div class="row">

                    <div class="card col-md-8">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h3 class="mb-0"><?php echo e(__('Edit Profile')); ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?php echo e(route('profile.update')); ?>" autocomplete="off"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('patch'); ?>

                                <h6 class="heading-small text-muted mb-4"><?php echo e(__('User information')); ?></h6>
                                
                                <?php echo $__env->make('alerts.success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php echo $__env->make('alerts.error_self_update', ['key' => 'not_allow_profile'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
                                <div class="pl-lg-4">
                                    <div class="form-group<?php echo e($errors->has('name') ? ' has-danger' : ''); ?>">
                                        <label class="form-control-label" for="input-name">
                                            <i class="w3-xxlarge fa fa-user"></i><?php echo e(__('Name')); ?>

                                        </label>
                                        <input type="text" name="name" id="input-name" class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('Name')); ?>" value="<?php echo e(old('name', auth()->user()->name)); ?>" required autofocus>
        
                                        <?php echo $__env->make('alerts.feedback', ['field' => 'name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                    <div class="form-group<?php echo e($errors->has('email') ? ' has-danger' : ''); ?>">
                                        <label class="form-control-label" for="input-email"><i class="w3-xxlarge fa fa-envelope-o"></i><?php echo e(__('Email')); ?></label>
                                        <input type="email" name="email" id="input-email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('Email')); ?>" value="<?php echo e(old('email', auth()->user()->email)); ?>" required>
        
                                        <?php echo $__env->make('alerts.feedback', ['field' => 'email'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-default mt-4"><?php echo e(__('Save')); ?></button>
                                    </div>
                                </div>
                            </form>
                            <hr class="my-4" />
                            <form method="post" action="<?php echo e(route('profile.password')); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('patch'); ?>
        
                                <h6 class="heading-small text-muted mb-4"><?php echo e(__('Password')); ?></h6>
        
                                <?php echo $__env->make('alerts.success', ['key' => 'password_status'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php echo $__env->make('alerts.error_self_update', ['key' => 'not_allow_password'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
                                <div class="pl-lg-4">
                                    <div class="form-group<?php echo e($errors->has('old_password') ? ' has-danger' : ''); ?>">
                                        <label class="form-control-label" for="input-current-password">
                                            <i class="w3-xxlarge fa fa-eye-slash"></i><?php echo e(__('Current Password')); ?>

                                        </label>
                                        <input type="password" name="old_password" id="input-current-password" class="form-control<?php echo e($errors->has('old_password') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('Current Password')); ?>" value="" required>
        
                                        <?php echo $__env->make('alerts.feedback', ['field' => 'old_password'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                    <div class="form-group<?php echo e($errors->has('password') ? ' has-danger' : ''); ?>">
                                        <label class="form-control-label" for="input-password">
                                            <i class="w3-xxlarge fa fa-eye-slash"></i><?php echo e(__('New Password')); ?>

                                        </label>
                                        <input type="password" name="password" id="input-password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('New Password')); ?>" value="" required>
        
                                        <?php echo $__env->make('alerts.feedback', ['field' => 'password'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-password-confirmation">
                                            <i class="w3-xxlarge fa fa-eye-slash"></i><?php echo e(__('Confirm New Password')); ?>

                                        </label>
                                        <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control" placeholder="<?php echo e(__('Confirm New Password')); ?>" value="" required>
                                    </div>
        
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-default mt-4"><?php echo e(__('Change password')); ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-user">
                            <div class="card-image">
                                <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="...">
                            </div>
                            <div class="card-body">
                                <div class="author">
                                    <a href="#">
                                        <img class="avatar border-gray" src="<?php echo e(asset('light-bootstrap/img/faces/face-3.jpg')); ?>" alt="...">
                                        <h5 class="title"><?php echo e(auth()->user()->name); ?></h5>
                                    </a>
                                    <p class="description">
                                        <?php echo e(__('Adminstrator')); ?>

                                    </p>
                                </div>
                                <p class="description text-center">
                                    <?php echo e(__(' Matheletics registered admin')); ?>

                                    <br> <?php echo e(__('2024 Matheletics Inc')); ?>

                                    <br> <?php echo e(__('Code republic ')); ?>

                                </p>
                            </div>
                            <hr>
                            <div class="button-container mr-auto ml-auto">
                                <button href="#" class="btn btn-simple btn-link btn-icon">
                                    <i class="fa fa-facebook-square"></i>
                                </button>
                                <button href="#" class="btn btn-simple btn-link btn-icon">
                                    <i class="fa fa-twitter"></i>
                                </button>
                                <button href="#" class="btn btn-simple btn-link btn-icon">
                                    <i class="fa fa-google-plus-square"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['activePage' => 'user', 'title' => 'Light Bootstrap Dashboard Laravel by Creative Tim & UPDIVISION', 'navName' => 'User Profile', 'activeButton' => 'laravel'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\mable\Desktop\Math_Challenge\example-app\resources\views/profile/edit.blade.php ENDPATH**/ ?>
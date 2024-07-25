<div class="sidebar" data-color="black" data-image="<?php echo e(asset('light-bootstrap/img/sidebar-4.jpg')); ?>">
    <!--
Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

Tip 2: you can also add an image using data-image tag
-->
    <div class="sidebar-wrapper">

        <div class="logo-container">
            <div class="logo-first-part">
                MATH
            </div>
            <div class="logo-second-part">
                LETICS
            </div>
        </div>

        <ul class="nav">
            <li class="nav-item <?php if($activePage == 'dashboard'): ?> active <?php endif; ?>">
                <a class="nav-link" href="<?php echo e(route('dashboard')); ?>">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p><?php echo e(__(" Admin Dashboard")); ?></p>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link active  bg-info" href="<?php echo e(route('page.index', 'uploadschools')); ?>">
                    
                    <p><?php echo e(__("UPLOAD SCHOOLS ")); ?></p>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link active  bg-info" href="<?php echo e(route('page.index', 'setChallengeParameters')); ?>">
                    
                    <p><?php echo e(__("SET CHALLENGE PARAMETERS ")); ?></p>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link active  bg-info" href="<?php echo e(route('page.index', 'analytics')); ?>">
                    
                    <p><?php echo e(__("ANALYTICS")); ?></p>
                </a>
            </li>

        </ul>
    </div>
</div>
<?php /**PATH C:\Users\mable\Desktop\Math_Challenge\example-app\resources\views/layouts/navbars/sidebar.blade.php ENDPATH**/ ?>
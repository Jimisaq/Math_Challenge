<?php if($errors->has($key)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo e($errors->first($key)); ?> <br>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?><?php /**PATH C:\Users\mable\Desktop\Math_Challenge\example-app\resources\views/alerts/error_self_update.blade.php ENDPATH**/ ?>
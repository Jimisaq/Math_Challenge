

<?php $__env->startSection('content'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload Schools</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Upload Schools</h1>
        
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p><?php echo e($error); ?></p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
        
        <form action="<?php echo e(route('schools.store')); ?>" method="POST" class="needs-validation" novalidate>
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="school_name">School Name:</label>
                <input type="text" name="school_name" id="school_name" class="form-control" required>
                <div class="invalid-feedback">
                    Please enter the school name.
                </div>
            </div>
            <div class="form-group">
                <label for="district">District:</label>
                <input type="text" name="district" id="district" class="form-control" required>
                <div class="invalid-feedback">
                    Please enter the district.
                </div>
            </div>
            <div class="form-group">
                <label for="registration_number">Registration Number:</label>
                <input type="text" name="registration_number" id="registration_number" class="form-control" required>
                <div class="invalid-feedback">
                    Please enter the registration number.
                </div>
            </div>
            <div class="form-group">
                <label for="representative_email">Representative Email:</label>
                <input type="email" name="representative_email" id="representative_email" class="form-control" required>
                <div class="invalid-feedback">
                    Please enter a valid email address.
                </div>
            </div>
            <div class="form-group">
                <label for="representative_name">Representative Name:</label>
                <input type="text" name="representative_name" id="representative_name" class="form-control" required>
                <div class="invalid-feedback">
                    Please enter the representative name.
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
        
    </div>

    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom JS to handle Bootstrap validation -->
    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>
</html>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', ['activePage' => 'dashboard', 'title' => 'Mathletics Challenge', 'navName' => 'Upload Schools', 'activeButton' => 'laravel'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\mable\Desktop\Math_Challenge\example-app\resources\views/pages/uploadschools.blade.php ENDPATH**/ ?>
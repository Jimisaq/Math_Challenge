

<?php $__env->startSection('content'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Analytics Dashboard</title>

    <!--
     * Script to handle countdown timer for challenges.
    -->
    <script>
        function countdown(element, endDate) {
            var countDownDate = new Date(endDate).getTime();

            var x = setInterval(function() {
                var now = new Date().getTime();
                var distance = countDownDate - now;

                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                if (element) {
                    element.innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

                    if (distance < 0) {
                        clearInterval(x);
                        element.innerHTML = "Expired";
                    }
                } else {
                    clearInterval(x);
                }
            }, 1000);
        }
        /**
         * Initializes the countdown timers for all challenges on page load.
         */
        window.onload = function(){
            document.querySelectorAll('.countdown').forEach(function(element){
                countdown(element, element.getAttribute('data-end'));
            });
        }
    </script>

    <style>
        .table-card{
            background-color: white;
            padding:2%;
            border-radius: 10px;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
        }
        .card{
            background-color: white;
            padding:2%;
            border-radius: 10px;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
        }
        table {
            width: 100%;
            margin-top: 20px;
            background-color: white;
            border: 1px solid #28a745;
            border-collapse: collapse;
        }
        thead{
            color:white;
            background-color: #28a745;
            text-transform: uppercase;
            font-size: small;
            font-weight:lighter;
        }
        thead tr:hover{
            background-color: #D2C8E3;
            color:black;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #28a745;
        }
        tr:hover {
            background-color: #EFEFF8;
        }
        h3{
            text-transform: uppercase;
            color:#17a2b8 ; 
            font-weight: bold;
        }
        h5{
            color:#28a745;
        }
    </style>    
</head>

<body>
    <div class="container">
        <br>

        <!--
         * Displays the top participants per challenge.
        -->

    <?php if(!empty($challenges)): ?>

    <div class="table-card">

        <h3> <u>Top participants per challenge</u> </h3>

        <table border="1" width="70%">
            <thead>
                <tr>
                    <th>Challenge Name</th>
                    <th>Participant Name</th>
                    <th>School Name</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $challenges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $challengeNo => $challenge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $challenge['participants']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $participant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <?php if($key === 0): ?>
                                <td rowspan="<?php echo e(count($challenge['participants'])); ?>"><?php echo e($challenge['challenge_name']); ?></td>
                            <?php endif; ?>
                            <td><?php echo e($participant['participant_name']); ?></td>
                            <td><?php echo e($participant['school_name']); ?></td>
                            <td><?php echo e($participant['score']); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

    <?php else: ?>
        <div class="alert alert-warning" role="alert">
            No participant data available.
        </div>
    <?php endif; ?>
    </div>
    <br>

    <!--
         * Displays the challenge countdown timers.
    -->
    <div class="card">
        <?php if(!empty($vchallenges)): ?>

            <div class="container">
        <h3><u>Challenge Countdown</u></h3>
        <br>
        <?php $__currentLoopData = $vchallenges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vchallenge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="challenge">
                <h5><?php echo e($vchallenge['challengeid']); ?>. <?php echo e($vchallenge['challengename']); ?></h5>
                <p>Ends in: <span class="countdown" data-end="<?php echo e($vchallenge['enddate']); ?>"></span></p>
            </div>
            <hr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
        <?php else: ?>
            <div class="alert alert-warning" role="alert">
                No valid challenges available.
            </div>
        <?php endif; ?>
    </div>
    
</body>
</html>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', ['activePage' => 'dashboard', 'title' => 'Mathletics Challenge', 'navName' => 'Analytics', 'activeButton' => 'laravel'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\mable\Desktop\Math_Challenge\example-app\resources\views/pages/analytics.blade.php ENDPATH**/ ?>
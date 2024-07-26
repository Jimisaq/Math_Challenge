<!DOCTYPE HTML>
<html>
<head>
    <title>The Mathletics</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="/assests/css/mainn.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
        crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <noscript><link rel="stylesheet" href="massets/css/noscript.css" /></noscript>

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
        let calcScrollValue = () => {
            let scrollProgress = document.getElementById('progress');  
            let pos = document.documentElement.scrollTop;
            
            if(pos>100){
                scrollProgress.style.display = 'grid';
            } 
            else{
                scrollProgress.style.display = 'none';
            }
            scrollProgress.addEventListener('click', () => {
                document.documentElement.scrollTop = 0;
            });
        };

        window.onscroll=calcScrollValue;
        window.onload=calcScrollValue;
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
        #progress{
            background-color: white;
            border:2px solid black;
            position: fixed;
            border-radius: 50%;
            bottom: 20px;
            right: 10px;
            height:60px;
            width:60px;
            display: none;
            box-shadow: 0 0 10px rgba(0,0,0, 0.2);
            cursor: pointer;
            z-index: 1000;
        }
        #progress-value{
            display: block;
            padding: 0%;
            width:50px;
            background-color:transparent;
            display: grid;
            text-align: center;
            font-weight: bold;
            font-size: 8px;
            font-family: 'Poppins';
            color:black;
        }
        #progress-value:hover{
            color:green;
        }
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
        .challenge p{
            color:black;
        }
        hr{
            border:1px solid gray;
        }
        table {
            width: 100%;
            margin-top: 20px;
            background-color: white;
            border: 1px solid #508b8e;
            border-collapse: collapse;
        }
        thead{
            color:white;
            background-color: #508b8e;
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
            border: 1px solid #508b8e;
            color:black;
        }
        tr:hover {
            background-color: #d08acc;
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
<body class="landing is-preload">

    <div id="progress">
        <span id="progress-value">SCROLL TO TOP</span>
    </div>
    <div id="page-wrapper">

        <!-- Header -->
        <header id="header" class="alt">
            <h1><a href="index.html">The Mathletics</a></h1>
            <nav id="nav">
                <ul>
                    <li class="special">
                        <a href="#menu" class="menuToggle"><span>Menu</span></a>
                        <div id="menu">
                            <ul>
                                <li><a href="<?php echo e(url('#page-wrapper')); ?>">Home</a></li>
                                <!-- <li><a href="generic.html">About</a></li>
                                <li><a href="elements.html">Rules</a></li>
                                <li><a href="#">Sign Up</a></li> -->
                                <li><a href="<?php echo e(route('login')); ?>">Log In</a></li>
                                <li><a href="<?php echo e(url('#table-card')); ?>">Winners</a></li>
                                <li><a href="<?php echo e(url('#card')); ?>">Challenges</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
        </header>

        <!-- Banner -->
        <section id="banner">
            <div class="inner">
               
                <h2>The Mathletics</h2>
                <p>Welcome to the finest interglobal<br/>online math competition<br/>crafted by Group-3.</p>
                <ul class="actions special">
                    <!-- <li><a href="#" class="button primary">Activate</a></li> -->
                </ul>
            </div>
            <!-- <a href="#one" class="more scrolly">Learn More</a> -->
        </section>

        <!-- Section One -->
        <section id="one" class="wrapper style1 special">
            <div class="inner">
                <header class="major">
                    <h2>Welcome to the Ultimate Mathematics Challenge!</h2>
                    <p>Join the brightest minds from around the world in this exciting competition. Sharpen your skills, test your limits, and see how you stack up against the best.</p>
                </header>
                <ul class="icons major">
                    <li><span class="icon fa-gem major style1"><span class="label">Excellence</span></span></li>
                    <li><span class="icon fa-heart major style2"><span class="label">Passion</span></span></li>
                    <li><span class="icon solid fa-code major style3"><span class="label">Precision</span></span></li>
                </ul>
            </div>
        </section>
            <br>
        <!-- Section Three -->
        <section id="three" class="wrapper style3 special">
            <div class="inner">
                <header class="major">
                    <h2>Why Participate in Mathletics?</h2>
                    <p>Experience the thrill of competition, improve your problem-solving skills, and earn recognition for your mathematical prowess.</p>
                </header>
                <ul class="features">
                    <li class="icon fa-paper-plane">
                        <h3>Global Recognition</h3>
                        <p>Compete with students worldwide and gain recognition for your skills on an international platform.</p>
                    </li>
                    <li class="icon solid fa-laptop">
                        <h3>Interactive Challenges</h3>
                        <p>Engage with a variety of challenging problems designed to test your mathematical abilities in a fun and interactive way.</p>
                    </li>
                    <li class="icon solid fa-code">
                        <h3>Skill Development</h3>
                        <p>Enhance your problem-solving techniques and mathematical understanding through rigorous challenges.</p>
                    </li>
                    <li class="icon solid fa-headphones-alt">
                        <h3>Community Support</h3>
                        <p>Join a community of like-minded individuals, share tips, and collaborate on solving complex problems.</p>
                    </li>
                    <li class="icon fa-heart">
                        <h3>Passion for Math</h3>
                        <p>Celebrate your love for mathematics and be inspired by others who share the same passion.</p>
                    </li>
                    <li class="icon fa-flag">
                        <h3>Award Recognition</h3>
                        <p>Win awards and certificates that recognize your achievements and dedication to mathematics.</p>
                    </li>
                </ul>
            </div>
        </section>

        <div>
        <div class="container">
        <br>

        <!--
         * Displays the top participants per challenge.
        -->

    <?php if(!empty($challenges)): ?>

    <div class="table-card" id="table-card">

        <h3> <u>Winners</u> </h3>

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
    <div class="card" id="card">
        <?php if(!empty($vchallenges)): ?>

            <div class="container">
        <h3><u>Challenges</u></h3>
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
        </div>

        <!-- Call to Action -->
        <section id="cta" class="wrapper style4">
            <div class="inner">
                <header>
                    <h2>Ready to Get Started?</h2>
                    <p>Get in touch with your school officials to join the competition and start your journey towards mathematical excellence.</p>
                </header>
                <ul class="actions stacked">
                    <!-- <li><a href="#" class="button fit primary">Activate</a></li> -->
                    <li><a href="#" class="button fit">Learn More</a></li>
                </ul>
            </div>
        </section>

        <!-- Footer -->
        <footer id="footer">
            <ul class="icons">
                <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
                <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
                <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
                <li><a href="#" class="icon brands fa-dribbble"><span class="label">Dribbble</span></a></li>
                <li><a href="#" class="icon solid fa-envelope"><span class="label">Email</span></a></li>
            </ul>
            <ul class="copyright">
                <li>&copy; Mathletics. All rights reserved.</li>
            </ul>
        </footer>

    </div>

    <!-- Scripts -->
    <script src="/assests/js/jquery.min.js"></script>
    <script src="/assests/js/jquery.scrollex.min.js"></script>
    <script src="/assests/js/jquery.scrolly.min.js"></script>
    <script src="/assests/js/browser.min.js"></script>
    <script src="/assests/js/breakpoints.min.js"></script>
    <script src="/assests/js/util.js"></script>
    <script src="/assests/js/main.js"></script>

</body>
</html><?php /**PATH C:\Users\mable\Desktop\Math_Challenge\example-app\resources\views/welcome.blade.php ENDPATH**/ ?>
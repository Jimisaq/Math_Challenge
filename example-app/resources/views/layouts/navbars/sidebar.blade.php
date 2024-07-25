<div class="sidebar" data-color="black" data-image="{{ asset('light-bootstrap/img/sidebar-4.jpg') }}">
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
            <li class="nav-item @if($activePage == 'dashboard') active @endif">
                <a class="nav-link  bg-info" href="{{route('dashboard')}}">
                    <p>{{ __(" ADMIN DASHBOARD") }}</p>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link active  bg-info" href="{{route('schools.add')}}">

                    <p>{{ __("REGISTER SCHOOL") }}</p>
                </a>
            </li>




            <li class="nav-item">
                <a class="nav-link active  bg-info" href="{{route('page.index', 'setChallengeParameters')}}">

                    <p>{{ __("SET CHALLENGE PARAMETERS ") }}</p>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link active  bg-info" href="{{route('analytics.index', 'analytics')}}">

                    <p>{{ __("ANALYTICS") }}</p>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link active  bg-info" href="{{route('page.index', 'viewcharts')}}">

                    <p>{{ __("VIEW CHARTS") }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>

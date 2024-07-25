@extends('layouts.app', ['activePage' => 'dashboard', 'title' => 'Mathletics Challenge', 'navName' => 'Analytics', 'activeButton' => 'laravel'])

@section('content')
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

    @if (!empty($challenges))

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
                @foreach ($challenges as $challengeNo => $challenge)
                    @foreach ($challenge['participants'] as $key => $participant)
                        <tr>
                            @if ($key === 0)
                                <td rowspan="{{ count($challenge['participants']) }}">{{ $challenge['challenge_name'] }}</td>
                            @endif
                            <td>{{ $participant['participant_name'] }}</td>
                            <td>{{ $participant['school_name'] }}</td>
                            <td>{{ $participant['score'] }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>

    @else
        <div class="alert alert-warning" role="alert">
            No participant data available.
        </div>
    @endif
    </div>
    <br>

    <!--
         * Displays the challenge countdown timers.
    -->
    <div class="card">
        @if (!empty($vchallenges))

            <div class="container">
        <h3><u>Challenge Countdown</u></h3>
        <br>
        @foreach ($vchallenges as $vchallenge)
            <div class="challenge">
                <h5>{{ $vchallenge['challengeid'] }}. {{ $vchallenge['challengename'] }}</h5>
                <p>Ends in: <span class="countdown" data-end="{{  $vchallenge['enddate'] }}"></span></p>
            </div>
            <hr>
        @endforeach
    </div>
        @else
            <div class="alert alert-warning" role="alert">
                No valid challenges available.
            </div>
        @endif
    </div>
    
</body>
</html>
@endsection
@extends('layouts.app', ['activePage' => 'dashboard', 'title' => 'Mathletics Challenge', 'navName' => 'Dashboard', 'activeButton' => 'laravel'])

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .overview {
            display: flex;
            justify-content: space-around;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .metric {
            flex: 1;
            margin: 10px;
            padding: 20px;
            background-color: lightslategray;
            color: white;
            box-shadow: 0 8px 6px -6px black;
            border-bottom: 1px solid #ddd;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            border-radius: 8px;
            text-align: center;
        }
        .metric:hover{
            background-color: #4CAF50;
        }
        .charts {
            width:100%;
            padding: 10px;
            height: auto;

        }
        .chart-container {
            /*width: 45%;*/
            margin: auto;
            margin-bottom: 20px;
            box-shadow:-5px 5px 20px 0 rgba(0, 0, 0, 0.74);
            background-color: white;
            height: 70vh;
        }
        .chart-container h6 {
            text-align: center;
            margin-bottom: 10px;

        }
        .tables {
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .filters {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            background-color: #f5f5f5;
            margin-bottom: 20px;
        }
        .filters label {
            margin-right: 10px;
        }
        .filters select, .filters input {
            margin-right: 20px;
        }
        .chart-container canvas {
           height: 80% !important;
           width: 80% !important;
            bottom: 0;
        }
    </style>
</head>
<body>

    <div class="overview">
        <div class="metric">
            <h3>Total Number of Schools</h3>
            <p id="correct-questions">{{ $data['totalSchools']}}</p> <!-- Laravel: Display count of correctly answered questions -->
        </div>
        <div class="metric">
            <h3>Total Participants</h3>
            <p id="correct-questions">{{ $data['totalParticipants']}}</p> <!-- Laravel: Display count of correctly answered questions -->
        </div>

        <div class="metric">
            <h3>Available Challenges</h3>
            <p id="correct-questions">{{ $data['availableChallenges']}}</p> <!-- Laravel: Display count of correctly answered questions -->

        </div>
    </div>

    <div class="container charts">
        <div class="row">
            <div class="col-lg-8 chart-container">
                <h3>Performance of Schools and Participants Over Time</h3>
                <canvas id="performanceChart"></canvas>
            </div>
        </div>
        <div>

        </div>

    </div>

    <div class="tables">
        <h3>Best Performing Schools</h3>
        <table id="bests-schools">
            <thead>
                <tr>
                    <th>School</th>
                    <th>Average Score</th>
                </tr>
            </thead>
            <tbody>

            @foreach($data['bestSchools'] as $school)
                <tr>
                    <td>{{ $school->school_name }}</td>
                    <td>{{ $school->avg_score }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <h3>Best Performing Schools</h3>
        <table id="worst-schools">
            <thead>
                <tr>
                    <th>School</th>
                    <th>Average Score</th>
                </tr>
            </thead>
            <tbody>

            @foreach($data['worstSchools'] as $school)
                <tr>
                    <td>{{ $school->school_name }}</td>
                    <td>{{ $school->avg_score }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <h3>Participants with Incomplete Challenges</h3>
        <table id="incomplete-challenges">
            <thead>
                <tr>
                    <th>Participant</th>
                    <th>Challenge</th>
                </tr>
            </thead>
            <tbody>

            @foreach($data['incompleteParticipants'] as $participant)
                <tr>
                    <td>{{ $participant->name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="filters">
        <label for="date-filter">Date:</label>
        <input type="date" id="date-filter" name="date-filter">

        <label for="category-filter">Category:</label>
        <select id="category-filter" name="category-filter">
            <option value="all">All</option>
            <option value="category1">Category 1</option>
            <option value="category2">Category 2</option>
        </select>

        <button id="apply-filters">Apply Filters</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
            // Example data for performance charts
            {{--//const sch = @json($schools);--}}
            console.log('Performance:', performance);

            const performanceData = {
            labels: ['2020', '2021', '2022', '2023'],
            datasets: [
        {

            label: 'schools',
            data: [75, 85, 80, 90],
            borderColor: 'rgba(255, 99, 132, 1)',
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            fill: true,
            tension: 0.1
        },
        {
            label: 'Participants',
            data: [65, 70, 75, 80],
            borderColor: 'rgba(54, 162, 235, 1)',
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            fill: true,
            tension: 0.1
        },
            ]
        };

            const repetitionData = {
            labels: ['Addition', 'Word Problems', 'Logis'],
            datasets: [{
            label: 'Repetition Percentage',
            data: [30, 45, 60],
            backgroundColor: 'rgba(153, 102, 255, 0.2)',
            borderColor: 'rgba(153, 102, 255, 1)',
            borderWidth: 1
        }]
        };

            // Create Performance Chart
            var ctx1 = document.getElementById('performanceChart').getContext('2d');
            var performanceChart = new Chart(ctx1, {
            type: 'line',
            data: performanceData,
            options: {
            responsive: true,
            plugins: {
            legend: {
            position: 'top',
        },
            tooltip: {
            callbacks: {
            label: function(tooltipItem) {
            return `${tooltipItem.dataset.label}: ${tooltipItem.formattedValue}%`;
        }
        }
        }
        },
            scales: {
            x: {

            title: {
            display: true,
            text: 'Year'
        }
        },
            y: {
            title: {
            display: true,
            text: 'Performance'
        },

            beginAtZero: true
        }
        }
        }
        });

            // Create Repetition Chart
            var ctx2 = document.getElementById('questionRepetitionChart').getContext('2d');
            var questionRepetitionChart = new Chart(ctx2, {
            type: 'bar',
            data: repetitionData,
            options: {
            responsive: true,
            plugins: {
            legend: {
            position: 'top',
        },
            tooltip: {
            callbacks: {
            label: function(tooltipItem) {
            return `${tooltipItem.dataset.label}: ${tooltipItem.formattedValue}%`;
        }
        }
        }
        },
            scales: {

            x: {
            title: {
            display: true,
            text: 'Participant'
        }
        },
            y: {
            title: {
            display: true,
            text: 'Repetition Percentage'
        },

            beginAtZero: true
        }
        }
        }
        });

            // Apply Filters
            document.getElementById('apply-filters').addEventListener('click', function() {
            let date = document.getElementById('date-filter').value;
            let category = document.getElementById('category-filter').value;

            fetch('/analytics/filter', {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
            body: JSON.stringify({ date, category })
        })
            .then(response => response.json())
            .then(data => {
            // Update metrics
            document.getElementById('correct-questions').innerText = data.questionsCount;
            document.getElementById('school-rankings').innerText = data.schoolsCount;

            // Update charts
            performanceChart.data.labels = data.performance.labels;
            performanceChart.data.datasets[0].data = data.performance.data[0];
            performanceChart.data.datasets[1].data = data.performance.data[1];
            performanceChart.update();

            questionRepetitionChart.data.labels =

            data.repetition.labels;
            questionRepetitionChart.data.datasets[0].data = data.repetition.data;
            questionRepetitionChart.update();

            // Update tables
            const worstSchoolsTableBody = document.getElementById('worst-schools').getElementsByTagName('tbody')[0];
            worstSchoolsTableBody.innerHTML = '';
            data.worstSchools.forEach(school => {
            const row = worstSchoolsTableBody.insertRow();
            row.insertCell(0).innerText = school.name;
            row.insertCell(1).innerText = school.score;
        });

            const bestSchoolsTableBody = document.getElementById('best-schools').getElementsByTagName('tbody')[0];
            bestSchoolsTableBody.innerHTML = '';
            data.bestSchools.forEach(school => {
            const row = bestSchoolsTableBody.insertRow();
            row.insertCell(0).innerText = school.name;
            row.insertCell(1).innerText = school.score;
        });

            const incompleteChallengesTableBody = document.getElementById('incomplete-challenges').getElementsByTagName('tbody')[0];
            incompleteChallengesTableBody.innerHTML = '';
            data.incompleteChallenges.forEach(participant => {
            const row = incompleteChallengesTableBody.insertRow();
            row.insertCell(0).innerText = participant.name;
            row.insertCell(1).innerText = participant.challenge;
        });
        });
        });
    </script>
        </body>
@endsection

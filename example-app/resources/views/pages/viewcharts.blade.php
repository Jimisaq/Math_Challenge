@extends('layouts.app', ['activePage' => 'dashboard', 'title' => 'Mathletics Challenge', 'navName' => 'Dashboard', 'activeButton' => 'laravel'])

@section('content')
  
    
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>CHART RANKINGS</title>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            
            <style>
                body {
                    background-color: rgba(255,255,255,0.2);/* light brown with 50% transparency */
                    position: relative;
                    /* overflow: hidden; */
                }
                body::before {
                    content: "";
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    width: 100%;
                    height: 100%;
                    background-image: url('https://www.teachprimary.com/images/content/hotproducts/NewMathLogo_whitetxt_CMYK_HR.png');
                    background-repeat: no-repeat;
                    background-size: contain;
                    background-position: center;
                    transform: translate(-50%, -50%) rotate(-45deg);
                    opacity: 0; /* Adjust opacity to make the watermark effect */
                    z-index: -1;
                }
                .chart-container {
                    display: flex;
                    justify-content: space-between;
                    margin: 20px;
                }
                .chart {
                    width: 70%;
                    margin-left: 50px;
                }

                hr.dark.horizontal {
                    border-top: 2px solid #000;
                    margin-top: 20px;
                }

                .left-aligned-heading {
                    text-align: left;
                }

                .right-aligned-heading {
                    text-align: right;
                }
            </style>
            
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <center>
                            <h2 class="mb-13">

                            CHART ANALYTICS    

                            </h2>
                        </center>
                </div>
                                                                
            </div>
        </head>

        <hr class="dark horizontal">

        <body>

            <center><h2>Participation Trend</h2></center>

            <div class = "class-container" style=" display:flex">

                <div class="chart">
                    <div style= "width: 80%; margin: left;">

                        <h3 class="left-aligned-heading" style=" text-align:center" >Gender Participation</h3>

                        <canvas id="genderParticipationChart" width="200" height="100"></canvas>
                    </div>
                </div>

                <div class="chart">
                    <div style= "width: 80%; margin: right;" >

                        <h3 class ="right-aligned-heading"  style=" text-align:center">School Rankings</h3>    
                
                        <canvas id="schoolRankingsChart" width="200" height="100"></canvas>
                    </div>

                </div>
        
            </div>

            <script>
                const genderLabels = ['2019', '2020', '2021', '2022', '2023', '2024'];
                const genderData = {
                    labels: genderLabels,
                    datasets: [
                        {
                            label: 'Female',
                            data: [28, 19, 40, 48, 57, 86], // Update this with your actual data
                            borderColor: 'rgba(255, 99, 132, 1)', 
                            backgroundColor: 'rgba(255, 99, 132, 20)',
                            yAxisID: 'y',
                            
                        },
                        {
                            label: 'Male',
                            data: [65, 59, 80, 67, 26, 78], // Update this with your actual data
                            borderColor: 'rgba(54, 162, 235, 1)',
                            backgroundColor: 'rgba(54, 162, 235, 20)',
                            yAxisID: 'y',  
                        }
                    ]
                };

                const genderConfig = {
                    type: 'line',
                    data: genderData,
                    options: {
                        responsive: true,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Gender participation over the years',
                            }
                        },
                        scales: {
                            x: {
                            title: {
                                display: true,
                                text: 'Years'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Number of Participants'
                            },
                            beginAtZero: true
                        }
                        },
                        
                    },
                };

                var genderParticipationChart = new Chart(
                    document.getElementById('genderParticipationChart'),
                    genderConfig
                );
            </script>


            <script>
                const schoolLabels =  ['Budo Junior School', 'Seeta Junior School', 'Makerere Primary School', 'Ntare Boys School', 'Viva Primary School'];
                const averageScores = [95.0, 92.3, 82.5, 80.1, 73.5];
                const participationRates = [91, 86, 60, 70, 60];

                const schoolData = {
                    labels: schoolLabels,
                    datasets: [
                        {
                            label: 'Average Score',
                            data: averageScores,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 20)',
                            type: 'bar',
                            
                        },
                        {
                            label: 'Participation Rate (%)',
                            data: participationRates,
                            borderColor: 'rgba(103, 102, 255, 1)',
                            backgroundColor: 'rgba(0, 255, 55, 0.5)',
                            type: 'bar',
                            
                        }
                    ]
                };

                const schoolConfig = {
                    type: 'bar',
                    data: schoolData,
                    options: {
                        responsive: true,
                        plugins: {
                            title: {
                                display: true,
                                text: 'School Rankings based off average score and participation rate'
                            }
                        },
                        scales: {
                            x: {
                            title: {
                                display: true,
                                text: 'Schools'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Average score and Participation rate'
                            },
                            beginAtZero: true
                        }
                        }
                    }
                };

                var schoolRankingsChart = new Chart(
                    document.getElementById('schoolRankingsChart'),
                    schoolConfig
                );
            </script>

            <hr class="dark horizontal">

            <center><h2>Performance Trend</h2></center>
            <div class="chart-container" style=" display:flex">
                <div class="chart">
                    <div style="width: 80%; margin: right;">

                        <h3 class="left-aligned-heading" style=" text-align:center">Schools Performance</h3>    
                        
                        <canvas id="schoolPerformanceChart" width="200" height="100"></canvas>
                    </div>
                </div>
                <div class="chart">
                    <div style="width: 80%; margin: right;">

                        <h3 class="right-aligned-heading" style=" text-align:center">Participants Performance</h3>    
                        
                        <canvas id="participantPerformanceChart" width="200" height="100"></canvas>
                    </div>
                </div>
            </div>

            <script>
                const schoolPerformanceYears = ['2019', '2020', '2021', '2022', '2023', '2024'];
                const noOfSchools = [5, 8, 18, 20, 17, 10]; // Replace with your actual data

                const schoolPerformanceData = {
                    labels: schoolPerformanceYears,
                    datasets: [{
                        label: 'Schools Performance',
                        data: noOfSchools,
                        borderColor: 'rgba(153, 102, 255, 1)',
                        backgroundColor: 'rgba(153, 102, 255, 20)',
                        pointStyle: 'circle', // You can use 'rect', 'star', etc.
                        pointRadius: 5,
                        pointHoverRadius: 8,
                        borderWidth: 2
                    }]
                };

                const schoolPerformanceConfig = {
                    type: 'line',
                    data: schoolPerformanceData,
                    options: {
                        responsive: true,
                        interaction: {
                            mode: 'index',
                            intersect: false
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: 'School Performance Over the Years'
                            }
                        },
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Years'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Schools Performance'
                                },
                                beginAtZero: true
                            }
                        }
                    }
                };

                var schoolPerformanceChart = new Chart(
                    document.getElementById('schoolPerformanceChart'),
                    schoolPerformanceConfig
                );
            </script>


            <script>

                const participantPerformanceYears = ['2019', '2020', '2021', '2022', '2023', '2024'];
                const noOfParticipants = [285, 92, 178, 288, 202, 301]; // Replace with your actual data

                const participantPerformanceData = {
                    labels: participantPerformanceYears,
                    datasets: [{
                        label: 'Participants Performanc',
                        data: noOfParticipants,
                        borderColor: 'rgba(255, 159, 64, 1)',
                        backgroundColor: 'rgba(255, 159, 64, 20)',
                        pointStyle: 'circle', // You can use 'rect', 'star', etc.
                        pointRadius: 5,
                        pointHoverRadius: 8,
                        borderWidth: 2
                    }]
                };

                const participantPerformanceConfig = {
                    type: 'line',
                    data: participantPerformanceData,
                    options: {
                        responsive: true,
                        interaction: {
                            mode: 'index',
                            intersect: false
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: 'Participants Performance Over the Years'
                            }
                        },
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Years'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Participants Performance'
                                },
                                beginAtZero: true
                            }
                        }
                    }
                };

                var participantPerformanceChart = new Chart(
                    document.getElementById('participantPerformanceChart'),
                    participantPerformanceConfig
                );
            </script>


            <hr class="dark horizontal">

            <center><h2>Challenges Trend</h2></center>


            <div class="chart-container" style=" display:flex">
                <div class="chart">
                    <div style="width: 80%; margin: right;">

                        <h3 class="left-aligned-heading" style=" text-align:center">Percentage Repetition of Questions </h3>    
                        
                        <canvas id="questionRepetitionChart" width="200" height="100"></canvas>
                    </div>
                </div>

                <div class="chart">
                    <div style="width: 50%; margin: right;">

                        <h3 class="right-aligned-heading" style=" text-align:center"> Attempt Challenges </h3>    
                        
                        <canvas id="challengesParticipationChart" width="200" height="100"></canvas>
                    </div>
                </div>

            </div>


            <script>
                const questionRepetitionLabels = ['Q32', 'Q22', 'Q18','Q9','Q87'];
                const questionRepetitionData = {
                    labels: questionRepetitionLabels,
                    datasets: [{
                        label: 'Percentage Repetition',
                        data: [10, 40, 48, 30, 26], // Replace with your actual data
                        backgroundColor: 'rgba(255, 206, 86, 20)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 1
                    }]
                };

                const questionRepetitionConfig = {
                    type: 'bar',
                    data: questionRepetitionData,
                    options: {
                        plugins: {
                                title: {
                                    display: true,
                                    text: 'Percentage Repetition of questions for a given participant across attempts'
                                }
                            },
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Question ID'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Percentage Repetition (%)'
                                },
                                beginAtZero: true
                            }
                        }
                    }
                };

                var questionRepetitionChart = new Chart(
                    document.getElementById('questionRepetitionChart'),
                    questionRepetitionConfig
                );
            </script>



            <script>
                const challengesParticipationLabels = ['Probability', 'Algebra', 'Geometry','Fractions & Decimals', 'Operations',];
                const challengesParticipationData = {
                    labels: challengesParticipationLabels,
                    datasets: [{
                        label: 'Number of Participants',
                        data: [10, 50, 25, 30, 75], // Replace with your actual data
                        backgroundColor: [
                            'rgba(255, 99, 132)',
                            'rgba(54, 162, 235)',  
                            'rgba(255, 206, 86)',
                            'rgb(153, 102, 255)',
                            'rgba(75, 192, 192)'

                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgb(153, 102, 255, 1)',
                            'rgba(75, 192, 192, 1)'
                        ],
                        borderWidth: 1
                    }]
                };

                const challengesParticipationConfig = {
                    type: 'pie',
                    data: challengesParticipationData,
                    options: {
                        plugins: {
                            title: {
                                display: true,
                                text: 'Ranking challenges from most attempted to least attempted'
                            }
                        }
                    }
                };

                var challengesParticipationChart = new Chart(
                    document.getElementById('challengesParticipationChart'),
                    challengesParticipationConfig
                );
            </script>

        </body>
    </html>

@endsection
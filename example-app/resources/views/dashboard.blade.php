@extends('layouts.app', ['activePage' => 'dashboard', 'title' => 'Mathletics Challenge', 'navName' => 'Dashboard', 'activeButton' => 'laravel'])

@section('content')

    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title> DASHBOARD </title>

            <style>

                body {
                    background-color: rgba(255,255,255,0.2); /* Black with 20% transparency*/
                    position: relative;
                }

                body::before {
                    content: "";
                    background: url('{{asset('images/recess2.jpeg')}}') center/cover no-repeat;
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    opacity: 1;
                    z-index: -1;
                    background-size: contain; /* Ensures the image fits within the boundaries */
                    background-repeat: no-repeat; /* Prevents the image from repeating */
                    background-position: center; /* Centers the image */
                }
                .responsive-image {
                    width: 50%;
                    height: 50%;
                    max-width: 400px; /* Adjust the max-width as needed */
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

                .container {
                    max-width: 1200px;
                    margin: auto;
                }

                .card-container {
                    display: flex;
                }

                .card {
                    background-color: rgba(255,255,255,0.6); 
                    border-radius: 10px;
                    padding: 10px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 10);
                    height: 100%;
                    background-size: cover;
                   
                }

                .card-header h5, .card-body h6 {
                    margin: 0;
                }

                .card-body {
                    padding: 15px;
                }

                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 10px;
                }

                th, td {
                    text-align: left;
                    padding: 8px;
                    border-bottom: 1px solid #ddd;
                }

                th {
                    background-color: #f2f2f2;
                }

                tbody tr:hover {
                    background-color: #f1f1f1;
                }

                hr.dark.horizontal {
                    border-top: 2px solid #000;
                    margin-top: 20px;
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
                    <p id="school-rankings">{{ $data['validChallenges'] }}</p> <!-- Laravel: Display count of top schools -->--}}


                </div>
            </div>

            <div class="container-fluid mt-6 mb-6">
                <div class="row">
                    <div class="col-xl-12 col-sm-6 mb-xl-0 mb-4">
                        <div class = "card z-index-3">

                            <div class="card-header p-3 pt-2" >
                            

                                <div class="text-start pt-4">
                               
                                    <center><h1 class="mb-13">WELCOME TO THE MATHLETICS CHALLENGE</h1></center>
                                   
                                </div>
                            </div>

                            <hr class="dark horizontal ">

                            <div class="card-footer p-3">

                                <h3 class="mb-0"><center> <b> THE INTERNATIONAL EDUCATION SERVICES _IES</b></center></h3>
                                <h3 class="mb-0"><center> PROVIDING THE BEST CHALLENGES FOR PRIMARY SCHOOL PUPILS</center></h3>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                        
                    <div class="col-lg-6 col-md-12 mt-4 mb-3">

                            <div class="card z-index-3">

                                    <div class="card-header">

                                        <center><b>SCHOOL RANKINGS</b></center>

                                    </div>

                                    <div class="card-body">
                                        <center><p>Table showing how the schools were ranked overall </p></center>

                                        <table border="1">
                                            <thead>
                                                <tr>
                                                    <th>Rank</th>
                                                    <th>School Name</th>
                                                    <th>Average Score</th>
                                                    <th>Participation Rate</th>
                                                </tr>
                                            </thead>

                                            <tbody> 
                                                <tr>
                                                    <td>1</td>
                                                    <td>Budo Junior School</td>
                                                    <td>95.0</td>
                                                    <td>95%</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Seeta Junior School</td>
                                                    <td>92.3</td>
                                                    <td>86%</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Makerere Primary School</td>
                                                    <td>82.5</td>
                                                    <td>60%</td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Ntare Boys School</td>
                                                    <td>80.1</td>
                                                    <td>70%</td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>Viva Primary School</td>
                                                    <td>73.5</td>
                                                    <td>60%</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <hr class="dark horizontal">

                                    
                                        <div class="card-footer">

                                            <a href="http://127.0.0.1:8000/viewcharts" class="btn btn-primary">VIEW CHART</a>
                                            
                                        </div>                                   

                                    </div>
                                    
                            </div>
                    </div>
                            
                

                    <div class="col-lg-6 col-md-12 mt-4 mb-3">
    
                            <div class="card z-index-3">
    
                                    <div class="card-header">
    
                                        <center><b>PERCETANGE REPETITION OF QUESTIONS FOR A GIVEN PARTICIPANT ACROSS ATTEMPTS</b></center>
    
                                    </div>
    
                                    <div class="card-body">
                                        
                                    
                                        <center><p>Table showing the percentage repetition of questions for a given participant across attempts</p></center>
    
                                        <table border = "1">
                                            <thead>
                                                <tr>
                                                    <th>ChallengeAttempt ID</th>
                                                    <th>Question ID</th>
                                                    <th>Total Questions</th>
                                                    <th>Repeated Questions</th>
                                                    <th>Percentage Repetition (%)</th>
                                                </tr>
                                            </thead>
    
                                            <tbody>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Q32</td>
                                                    <td>100</td>
                                                    <td>10</td>
                                                    <td>10%</td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td>Q22</td>
                                                    <td>100</td>
                                                    <td>25</td>
                                                    <td>40%</td>
                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Q18</td>
                                                    <td>100</td>
                                                    <td>45</td>
                                                    <td>48.2%</td>
                                                </tr>
                                                <tr>
                                                    <td>17</td>
                                                    <td>Q9</td>
                                                    <td>100</td>
                                                    <td>32</td>
                                                    <td>30%</td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Q87</td>
                                                    <td>100</td>
                                                    <td>18</td>
                                                    <td>26%</td>
                                                </tr>
                                            </tbody>
    
                                        </table>
                                        
    
                                        <hr class="dark horizontal">
                                       
                                        <div class="card-footer">
    
                                            <a href="http://127.0.0.1:8000/viewcharts" class="btn btn-primary">VIEW CHART</a>
                                            
                                        </div>
       
                                    </div>
                                    
                            </div>                    

                    </div>
                            
                </div> 
                

                <div class="row ">
                        
                    <div class="col-lg-6 col-md-12 mt-4 mb-3">


                        <div class="card z-index-3">

                            <div class="card-header">

                                <center><b>BEST PERFORMING SCHOOLS FOR ALL CHALLENGES</b></center>

                            </div>

                            <div class="card-body">

                                <center><p>List showing the top 3 schools </p></center>

        
                                <ol>
                                    <li>Budo Junior School</li>
                                    <li>Seeta Junior School</li>
                                    <li>Ntare Boys Primary School</li>
                                                
                                </ol>
                                
                                                                                                         
                                <div class="card-footer"> 

                                    <hr class="dark horizontal">

                                </div>
                                  
                            </div>

                        </div>

                    </div>
                           
                
                    <div class="col-lg-6 col-md-12 mt-4 mb-3">
               
                        <div class="card z-index-3">

                            <div class="card-header">

                                <center><b>WORST PERFORMING SCHOOLS PER CHALLENGE</b></center>
                            </div>

                            <div class="card-body">
                                                
                                <center><b><p>List showing the two worst performing schools per challenge</p></b> </center>
                                    

                                <ol>
                                    <li>
                                        <strong>Algebra</strong>
                                            <ol type="a">
                                                <li>Makerere Primary School </li>
                                                <li>Viva Primary School </li>
                                            </ol>

                                    </li>

                                    <li>
                                        <strong>Operations</strong>
                                            <ol type="a">
                                                <li>Ntare Boys Primary School </li>
                                                <li>Seeta Junior School </li>
                                            </ol>
                                    </li>

                                    <li>
                                        <strong>Fractions & Decimals</strong>
                                            <ol type="a">
                                                <li>Budo Junior School </li>
                                                <li>Seeta Junior School </li>
                                            </ol>
                                    </li>

                                    <li>
                                        <strong>Geometry</strong>
                                            <ol type="a">
                                                <li>Makerere Primary School </li>
                                                <li>Ntare Boys Primary School </li>
                                            </ol>
                                    </li>

                                    <li>
                                        <strong>Probability</strong>
                                            <ol type="a">
                                                <li>Budo Junior School </li>
                                                <li>Viva Primary School </li>
                                            </ol>
                                    </li>

                                </ol>

                                <hr class="dark horizontal">

                                <div class="card-footer">    </div>
                                         
                               
                                    
                            </div>
                                    
                            
                        </div>

                    </div>

                </div>

               

                <div class="row">

                    <div class="col-lg-6 col-md-12 mt-4 mb-3">

                        <div class="card z-index-3">

                            <div class="card-header">
                                <center><b>PARTICIPANTS WITH INCOMPLETE CHALLENGES</b></center>
                            </div>

                            <div class="card-body">
                                <center>
                                    <b><p>List showing participants with incomplete challenges and their schools</p></b>
                                </center>

                                <ol>
                                    <li>
                                        <strong>Algebra</strong>
                                        <ul>
                                            <li>Saul Sabunyo - Budo Junior School</li>
                                        </ul>
                                    </li>
                                    <li>
                                        <strong>Probability</strong>
                                        <ul>
                                            <li>Jane Sandra - Seeta Junior School</li>
                                        </ul>
                                    </li>
                                    <li>
                                        <strong>Geometry</strong>
                                        <ul>
                                            <li>Michael Bandana - Ntare Boys Primary School</li>
                                        </ul>
                                    </li>
                                    <li>
                                        <strong>Operations</strong>
                                        <ul>
                                            <li>Cathy Miles - Viva Primary School</li>
                                        </ul>
                                    </li>
                                    <li>
                                        <strong>Fractions & Decimals</strong>
                                        <ul>
                                            <li>David Mason - Makerere Primary School</li>
                                        </ul>
                                    </li>
                                </ol>

                                <hr class="dark horizontal">

                                <div class="card-footer">    </div>

                            </div>
                        </div>
                    </div>
               

                    <div class="col-lg-6 col-md-12 mt-4 mb-3">
                

                        <div class="card z-index-3">

                            <div class="card-header">

                                <center><b>MOST CORRECTLY ANSWERED QUESTIONS</b></center>

                            </div>

                            <div class="card-body">
                                                                    
                                <center><b><p>Table showing 5 most correctly answered questions </p></b></center>
                                 
                                <table border ="1">
                                    <thead>
                                        <tr>
                                            <th>Question</th>
                                            <th>Correct Answers</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>Solve for x: 4x = 20 </td>
                                            <td>200</td>
                                        </tr>

                                        <tr>
                                            <td>Divide: ( 100 by 5 )   </td>
                                            <td>180</td>
                                        </tr>

                                        <tr>
                                            <td>Convert 0.25 to a fraction  </td>
                                            <td>100</td>
                                        </tr>

                                        <tr>
                                            <td>How many faces does a cube have? </td>
                                            <td>60</td>
                                        </tr>

                                        <tr>
                                            <td>If a family has three children, what is the probability that all three are girls?  </td>
                                            <td>50</td>
                                        </tr>

                                    </tbody>

                                </table>


                                <hr class="dark horizontal">

                                   
                                <div class="card-footer">    </div>
                                                         

                            </div>
                                
                        </div>
                        
                    </div>

                </div>
   

            </div>
                

        </body> 
    </html>
@endsection







<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\Participant;
use App\Models\School;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //get the total number of schools in the database
        $totalSchools = School::count();
        //Total number of participants
        $totalParticipants = Participant::count();
        //Valid challenges
        //$validChallenges = Challenge::where('status', 'valid')->count();

        //store variables in an array
        $data = [
            'totalSchools' => $totalSchools,
            'totalParticipants' => $totalParticipants,
            //'validChallenges' => $validChallenges
        ];

        $school= School::pluck('school_name');

        return view('dashboard',compact('school'))->with('data', $data);
    }

}

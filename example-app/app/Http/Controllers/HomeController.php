<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\ChallengeAttempt;
use App\Models\Participant;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
//

    public function index()
    {
        // Get the total number of schools in the database
        $totalSchools = School::count();
        // Total number of participants
        $totalParticipants = Participant::count();
        // Count of the available challenges(those whose start date is before current date and end date is after current date)
        $availableChallenges = Challenge::where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->count();



        // Get the best performing schools
        $bestSchools = School::select('school.school_name', \DB::raw('AVG(challengeattempt.score) as avg_score'))
            ->join('participant', 'school.registration_number', '=', 'participant.school_reg_no')
            ->join('challengeattempt', 'participant.id', '=', 'challengeattempt.participant_id')
            ->groupBy('school.school_name')
            ->orderBy('avg_score', 'desc')
            ->limit(5)
            ->get();

        // Get the worst performing schools
        $worstSchools = School::select('school.school_name', \DB::raw('AVG(challengeattempt.score) as avg_score'))
            ->join('participant', 'school.registration_number', '=', 'participant.school_reg_no')
            ->join('challengeattempt', 'participant.id', '=', 'challengeattempt.participant_id')
            ->groupBy('school.school_name')
            ->orderBy('avg_score', 'asc')
            ->limit(5)
            ->get();

        // Get participants with incomplete challenges and their challenge names
        $incompleteParticipants = Participant::select('participant.name', 'challenge.challenge_name')
            ->join('challengeattempt', 'participant.id', '=', 'challengeattempt.participant_id')
            ->join('challenge', 'challengeattempt.challenge_no', '=', 'challenge.id')
            ->where('challengeattempt.complete', 0)
            ->get();

        // Get performance data over time

        $performanceData = DB::table('challengeattempt')
            ->join('participant', 'challengeattempt.participant_id', '=', 'participant.id')
            ->join('school', 'participant.school_reg_no', '=', 'school.registration_number')
            ->select(
                'school.school_name',
                'participant.name as participant_name',
                'challengeattempt.score',
                'challengeattempt.end_time'
            )
            ->orderBy('challengeattempt.end_time')
            ->get();

        // Get attempts data against challenge names
        $attemptsData = DB::table('challengeattempt')
            ->join('challenge', 'challengeattempt.challenge_no', '=', 'challenge.id')
            ->select(
                'challenge.challenge_name',
                \DB::raw('COUNT(challengeattempt.id) as attempts')
            )
            ->groupBy('challenge.challenge_name')
            ->orderBy('challenge.challenge_name')
            ->get();

        // Store variables in an array
        $data = [
            'totalSchools' => $totalSchools,
            'totalParticipants' => $totalParticipants,
            'availableChallenges' => $availableChallenges,
            'bestSchools' => $bestSchools,
            'worstSchools' => $worstSchools,
            'incompleteParticipants' => $incompleteParticipants,
            'performanceData' => $performanceData,
            'attemptData' => $attemptsData
        ];

        return view('dashboard', compact('data'));
    }

}

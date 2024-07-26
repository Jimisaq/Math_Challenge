<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Participant;
use App\Models\ChallengeAttempt;
use App\Models\Challenge;

class ViewChartsController extends Controller
{
   
    public function index()
    {
       $rankings = $this->calculateRankings();
       $otherData = $this->getOtherData(); // Fetch additional data for charts or statistics
       return view('pages.viewcharts', compact('rankings', 'otherData'));
    }

    public function calculateRankings()
    {
        $rankings = School::select('schools.registration_number', 'schools.school_name')
            ->leftJoin('participant', 'schools.registration_number', '=', 'participant.school_reg_no')
            ->leftJoin('challengeattempt', 'participant.id', '=', 'challengeattempt.participant_id')
            ->selectRaw('
                schools.registration_number,
                schools.school_name,
                AVG(challengeattempt.score) as average_score,
                COUNT(DISTINCT participant.id) as participant_count,
                COUNT(DISTINCT challengeattempt.id) as total_attempts,
                COUNT(DISTINCT challengeattempt.challenge_no) as unique_challenges
        ')
        ->groupBy('schools.registration_number', 'schools.school_name')
        ->orderByDesc('average_score')
        ->orderByDesc('participant_count')
        ->get()
        ->map(function ($school) {
            $totalChallenges = Challenge::count();
            $school->participation_rate = $totalChallenges > 0 ? ($school->unique_challenges / $totalChallenges) * 100 : 0;
            return $school;
        });


        
    return $rankings;    

    }

    
    public function showRepetitions($participantId)
    {
        $data = DB::table('challengeattempt as ca')
            ->join('attemptedquestion as aq', 'ca.id', '=', 'aq.id')
            ->join('questions as q', 'aq.question_no', '=', 'q.id')
            ->select(
                'ca.participant_id',
                'ca.id',
                'q.id',
                'q.question_text',
                'ca.start_time',
                DB::raw('COUNT(q.id) AS repetition_count'),
                DB::raw('(COUNT(q.id) * 100.0 / (SELECT COUNT(*) FROM challengeattempt WHERE participant_id = ca.participant_id)) AS percentage_repetition')
            )
            ->where('ca.participant_id', $participantId)
            ->groupBy('ca.participant_id', 'ca.id', 'q.id', 'q.question_text', 'ca.start_time')
            ->orderBy('ca.start_time')
            ->get();

        return view('pages.viewcharts', compact('data'));
    }
    private function getOtherData()
    {
        return[]; // To fetch additional data
    }

}

   


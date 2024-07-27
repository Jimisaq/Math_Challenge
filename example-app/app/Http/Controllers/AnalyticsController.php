<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Challenge;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function index()
    {
        $challenges = AnalyticsController::getTopTwoParticipants();
        $vchallenges = AnalyticsController::displayChallenges();
        return view('pages.analytics', compact('challenges','vchallenges'));
    }

    public function getTopTwoParticipants()
    {
       $topParticipants = DB::table('challengeattempt')
        ->join('challenge', 'challengeattempt.challenge_no', '=', 'challenge.id')
        ->join('participant', 'challengeattempt.participant_id', '=', 'participant.id')
        ->join('school', 'participant.school_reg_no', '=', 'school.registration_number')
        ->select(
            'challengeattempt.challenge_no',
            'challenge.challenge_name',
            'participant.name as participant_name',
            'school.school_name',
            'challengeattempt.score',
            'challenge.end_date'
            )
        ->orderBy('challengeattempt.challenge_no')
        ->orderByDesc('challengeattempt.score')
        ->get();

        $challenges = [];

        foreach ($topParticipants as $participant) {
            $challengeNo = $participant->challenge_no;
            if (!isset($challenges[$challengeNo])) {
                $challenges[$challengeNo] = [
                    'challenge_name' => $participant->challenge_name,
                    'participants' => [],
                    'expired' => false,
                ];
            }

            $challengeEndDate = Carbon::parse($participant->end_date);

            if ($challengeEndDate < now()) {
                $challenges[$challengeNo]['expired'] = true;
            }

            // Ensure 'participants' is an array before accessing it
            if ($challenges[$challengeNo]['expired'] && is_array($challenges[$challengeNo]['participants']) && count($challenges[$challengeNo]['participants']) < 2) {
                $challenges[$challengeNo]['participants'][] = [
                    'participant_name' => $participant->participant_name,
                    'school_name' => $participant->school_name,
                    'score' => $participant->score,
                ];
            }
        }
        return $challenges;
    }

    public function displayChallenges()
    {
        $validchallenges = DB::table('challenge')
        ->select('id', 'challenge_name', 'start_date', 'end_date')
        ->orderByDesc('end_date')
        ->get();

        $vchallenges=[];

        foreach ($validchallenges as $validchallenge) {
                $vchallenges[] = [
                    'challengeid' => $validchallenge->id,
                    'challengename' => $validchallenge->challenge_name,
                    'startdate' => $validchallenge->start_date,
                    'enddate' => $validchallenge->end_date,
                ];
            }

        return $vchallenges;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ChallengeAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Analytics1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $challenges = Analytics1Controller::getTopTwoParticipants();
        $vchallenges = Analytics1Controller::displayChallenges();
        return view('welcome', compact('challenges','vchallenges'));
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


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChallegeAttempt  $challegeAttempt
     * @return \Illuminate\Http\Response
     */
    public function show(ChallegeAttempt $challegeAttempt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChallegeAttempt  $challegeAttempt
     * @return \Illuminate\Http\Response
     */
    public function edit(ChallegeAttempt $challegeAttempt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChallegeAttempt  $challegeAttempt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChallegeAttempt $challegeAttempt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChallegeAttempt  $challegeAttempt
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChallegeAttempt $challegeAttempt)
    {
        //
    }
}

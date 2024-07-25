<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AttemptedQuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Participants configuration
        $participants = [
            ['id' => 1, 'count' => 10],
            ['id' => 2, 'count' => 10],
            ['id' => 3, 'count' => 5],
            ['id' => 4, 'count' => 6],
            ['id' => 5, 'count' => 3],
            ['id' => 6, 'count' => 7],
            ['id' => 7, 'count' => 8],
        ];

        foreach ($participants as $participant) {
            $participant_id = $participant['id'];
            $count = $participant['count'];

            // Generate unique question numbers
            $unique_questions = range(1, 10);
            shuffle($unique_questions);

            for ($i = 0; $i < $count; $i++) {
                DB::table('attemptedquestion')->insert([
                    'challenge_no' => rand(1, 5), // Assuming there are 5 different challenges
                    'participant_id' => $participant_id,
                    'question_no' => $unique_questions[$i],
                    'start_time' => Carbon::now()->subDays(rand(0, 365)),
                    'status' => rand(0, 1) ? 'passed' : 'failed',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}

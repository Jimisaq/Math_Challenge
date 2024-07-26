<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChallengesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('challenges')->insert([
                'challenge_name' => 'Challenge ' . $i,
                'start_date' => Carbon::now()->subDays(rand(1, 365)),
                'end_date' => Carbon::now()->addDays(rand(1, 365)),
                'challenge_duration' => rand(30, 180), // Duration in minutes
                'number_of_questions' => rand(5, 20),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}

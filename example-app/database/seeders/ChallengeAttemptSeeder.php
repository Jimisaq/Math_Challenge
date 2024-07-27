<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ChallengeAttemptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
        public function run() {
            $faker = Faker::create();
            foreach (range(1, 200) as $index) {
                DB::table('challengeattempt')->insert([ 'participant_id' => $faker->numberBetween(1, 50),
                    'challenge_no' => $faker->numberBetween(1, 10),
                    'score' => $faker->numberBetween(0, 10),
                    'start_time' => $faker->dateTimeThisMonth(),
                    'end_time' => $faker->dateTimeThisMonth(),
                    'complete' => $faker->boolean,
                    ]);
            }
        }
}

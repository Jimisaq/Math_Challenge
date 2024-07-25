<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ParticipantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('participant')->insert([
                'name' => 'Participant ' . $i,
                'user_name' => 'username' . $i,
                'password' => bcrypt('password' . $i),
                'email' => 'participant' . $i . '@example.com',
                'date_of_birth' => Carbon::now()->subYears(rand(18, 30))->toDateString(),
                'school_reg_no' => 'REG' . Str::random(5),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}

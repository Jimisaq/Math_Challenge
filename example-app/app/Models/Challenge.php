<?php

// app/Models/Challenge.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;
    protected $table = 'challenge';
    protected $fillable = [
        'challenge_name',
        'start_date',
        'end_date',
        'challenge_duration',
        'number_of_questions',
    ];

    protected $dates = ['start_date','end_date'];
}

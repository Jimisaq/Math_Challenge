<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttemptedQuestion extends Model
{
    use HasFactory;

    // Specify the table if it's not the plural of the model name
    protected $table = 'attemptedquestion';

    // Define the columns that are mass assignable (if any)
    protected $fillable = ['challenge_no', 'participant_id', 'question_no', 'status', 'start_time'];
}

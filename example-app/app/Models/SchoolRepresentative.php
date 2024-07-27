<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolRepresentative extends Model
{
    use HasFactory;
    protected $table = 'SchoolRepresentative';

    protected $fillable = [
        'school_reg_no',
        'name',
        'email',
        'password',
    ];
}

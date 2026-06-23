<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameScoreSingle extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'score',
        'correct',
        'incorrect',
        'total_questions',
        'time_seconds',
        'mode',
        'match_uuid'
    ];
}

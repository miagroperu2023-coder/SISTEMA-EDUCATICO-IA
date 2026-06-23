<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsAppsUserQuestionSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'question_id',
    ];
}

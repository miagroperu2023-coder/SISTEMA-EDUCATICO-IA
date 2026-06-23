<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;


    protected $fillable = [
        'titulo',
        'es_correcta',
        'question_id'
    ];


    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function examUserAnswers()
    {
        return $this->hasMany(ExamUserAnswer::class);
    }
}

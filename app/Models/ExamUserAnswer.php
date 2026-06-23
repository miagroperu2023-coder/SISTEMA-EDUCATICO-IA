<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamUserAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_user_id',
        'exam_question_id',
        'answer_id',
        'puntos',
    ];


    public function examUser()
    {
        return $this->belongsTo(ExamUser::class);
    }

    public function examQuestion()
    {
        return $this->belongsTo(ExamQuestion::class);
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}

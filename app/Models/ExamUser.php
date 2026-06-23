<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'calificacion',
        'observaciones',
        'status',
        'user_id',
        'exam_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function examUserAnswers()
    {
        return $this->hasMany(ExamUserAnswer::class);
    }
}

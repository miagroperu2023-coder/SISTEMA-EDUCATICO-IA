<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;


    protected $fillable = [
        'titulo',
        'comentario',
        'dificultad',
        'puntos',
        'estado',
        'section_id',
        'user_id'
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function examQuestions()
    {
        return $this->hasMany(ExamQuestion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

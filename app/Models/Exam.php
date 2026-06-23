<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    const ACTIVO = 'activo';
    const PENDIENTE = 'pendiente';
    const INACTIVO = 'inactivo';


    protected $fillable = [
        'nombre',
        'slug',
        'duracion',
        'estado',
        'publicacion',
        'type',
        'user_id',
        'course_id'
    ];

    /**
     * Relación: Un examen pertenece a un usuario (autor).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: Un examen pertenece a un curso.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function examUsers()
    {
        return $this->hasMany(ExamUser::class);
    }

    public function examQuestions()
    {
        return $this->hasMany(ExamQuestion::class);
    }
}

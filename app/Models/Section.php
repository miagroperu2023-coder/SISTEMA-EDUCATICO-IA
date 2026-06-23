<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    //HABILITAR ASIGNACION MASIVA
    protected $guarded = ['id'];

    //RELACION UNO A MUCHOS INVERSA UNA SECCION PUEDE ESTAR EN UNO O MUCHOS CURSOS
    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

    //RELACION  DE UNO A MUCHOS "me retorna las lecciones de una seccion"
    public function lessons()
    {
        return $this->hasMany('App\Models\Lesson');
    }

    /**
     * Relación: Una sección tiene muchas preguntas.
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}

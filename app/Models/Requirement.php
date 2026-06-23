<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    use HasFactory;

    //HABILITAR ASIGNACION MASIVA
    protected $guarded = ['id'];

    //RELACION UNO A MUCHOS INVERSA UN REQUERIMIENTO PUEDE ESTAR EN UNO O MUCHOS CURSOS
    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }
}

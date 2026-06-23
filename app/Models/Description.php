<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    use HasFactory;

    //HABILITAR ASIGNACION MASIVA
    protected $guarded = ['id'];

    //RELACION UNO A UNO INVERSA
    public function lessons()
    {
        return $this->belongsTo('App\Models\Lesson');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    //HABILITAR ASIGNACION MASIVA
    protected $guarded = ['id'];

    //RELACION UNO A MUCHOS INVERSA ""
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


    //RELACION UNO A MUCHOS INVERSA ""
    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }
}

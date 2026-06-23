<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    //HABILITAR ASIGNACION MASIVA
    protected $guarded = ['id'];

    //RELACION UNO A MUCHOS INVERSA UNA LESSON PUEDE ESTAR EN UNO O MUCHOS SECTION
    public function section()
    {
        return $this->belongsTo('App\Models\Section');
    }

    //RELACION UNO A MUCHOS INVERSA
    public function platform()
    {
        return $this->belongsTo('App\Models\Platform');
    }

    //RELACION UNO A UNO
    public function description()
    {
        return $this->hasOne('App\Models\Description');
    }

    //RELACION MUCHOS A MUCHOS
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    //RELACION UNO A UNO POLIMORFICA
    public function resource()
    {
        return $this->morphOne('App\Models\Resource', 'resourceable');
    }

    //RELACION UNO A MUCHOS POLIMORFICA
    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

    //RELACION UNO A MUCHOS POLIMORFICA
    public function reactions()
    {
        return $this->morphMany('App\Models\Reaction', 'reactionable');
    }

    //METODO PARA VER SI UNA LECCION ESTA CULMINADA tabla "lesson_user"
    public function getCompletedAttribute()
    {
        //true: si el usuario a marcado como culminado
        //false: si el usuario aun no lo marca
        return $this->users->contains(auth()->user()->id);
    }
}

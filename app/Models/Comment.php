<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    //HABILITAR ASIGNACION MASIVA
    protected $guarded = ['id'];

    //RELACION UNO A MUCHOS INVERSA
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    //COMENTARIOS PUEDEN TENER REACCIONES
    public function reactions()
    {
        return $this->morphMany('App\Models\Reaction', 'reactionable');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class , 'parent_id');
    }

    //UN COMENTARIO PUEDE HACER OTRO COMENTARIO
    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }
}

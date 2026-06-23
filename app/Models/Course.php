<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    //HABILITAR ASIGNACION MASIVA
    //HABILITAR ASIGNACION MASIVA
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'status',
        'slug',
        'level_id',
        'user_id',
        'category_id',
        'price_id'
    ];

    //ESTUDIANTES INSCRITOS EN EL CURSO "es como un Course->student"
    protected $withCount = ['students', 'reviews'];

    const BORRADOR = 1;
    const REVISION = 2;
    const PUBLICADO = 3;

    //RETORNAR LA CANTIDAD DE ESTRELLAS"calificaciones" DE UN CURSO
    public function getRatingAttribute()
    {
        if ($this->reviews_count) {
            return round($this->reviews->avg('rating'), 2);
        } else {
            return 5; // o el valor predeterminado que desees
        }
    }

    //RELACION UNO A MUCHOS INVERSA "me retorna al usuario que a dictado el curso"
    public function teacher()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    //RELACION MUCHOS A MUCHOS "me retorna todos los estudiantes que tenga este curso"
    public function students()
    {
        return $this->belongsToMany('App\Models\User');
    }

    //RELACION UNA A MUCHOS CURSO PUEDE TENER MUCHOS REVIEWS"me retorna los reviews que dejaron en cada curso"
    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    //RELACION DE UNO A MUCHOS INVERSA ""
    public function level()
    {
        return $this->belongsTo('App\Models\Level');
    }

    //RELACION DE UNO A MUCHOS INVERSA ""
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    //RELACION DE UNO A MUCHOS INVERSA ""
    public function price()
    {
        return $this->belongsTo('App\Models\Price');
    }

    //RELACION DE UNO A MUCHOS "me retorna los requerimientos del curso"
    public function requirements()
    {
        return $this->hasMany('App\Models\Requirement');
    }

    //RELACION DE UNO A MUCHOS "me retorna los goals"metas" del curso"
    public function goals()
    {
        return $this->hasMany('App\Models\Goal');
    }

    //RELACION DE UNO A MUCHOS "me retorna las audicencias del curso"
    public function audiences()
    {
        return $this->hasMany('App\Models\Audience');
    }

    //RELACION DE UNO A MUCHOS "me retorna las secciones del curso"
    public function sections()
    {
        return $this->hasMany('App\Models\Section');
    }

    //RELACION UNO A UNO POLIMORFICA
    public function image()
    {
        return $this->morphOne('App\Models\Image', 'imageable');
    }

    //
    public function lessons()
    {
        return $this->hasManyThrough('App\Models\Lesson', 'App\Models\Section');
    }

    //DEFINIR LA RELACION CON ARCHIVE
    public function archives()
    {
        return $this->hasMany(Archive::class);
    }

    public function freeStudents()
    {
        return $this->belongsToMany('App\Models\User', 'course_user_free', 'course_id', 'user_id');
    }

    /**
     * Relación: Un curso tiene muchos exámenes.
     */
    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}

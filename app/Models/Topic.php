<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;


    const ACTIVO = 'activo';
    const INACTIVO = 'inactivo';

    protected $fillable = [
        'nombre',
        'estado',
    ];

    
}

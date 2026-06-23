<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'promo_code',
        'slug',
        'user_id',
        'name',
        'months',
        'monthly_price',
        'percentage',
        'activo',
    ];

    // Relación: un plan pertenece a un usuario (quien lo creó, por ejemplo)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

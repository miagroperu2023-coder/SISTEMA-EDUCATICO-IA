<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    use HasFactory;

    //CAMPOS DE LA TABLA DE LA BASE DE DATOS
    protected $fillable = [
        'user_id',
        'collection_id',
        'collection_status',
        'payment_id',
        'status',
        'external_reference',
        'payment_type',
        'merchant_order_id',
        'preference_id',
        'site_id',
        'processing_mode',
        'merchant_account_id',
        'estado',
        'date_start',
        'date_end'
    ];

    //cada pago pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

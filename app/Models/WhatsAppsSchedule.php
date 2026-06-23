<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsAppsSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'day',
        'time'
    ];
}

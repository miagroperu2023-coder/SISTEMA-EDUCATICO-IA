<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'min_points', 'max_points', 'avatar', 'background'];

    public function playerRanks()
    {
        return $this->hasMany(PlayerRank::class);
    }
}

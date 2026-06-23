<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'status',
        'creator_id',
        'winner_id',
        'category_id',
        'category_type', // Asegúrate de incluirlo aquí
        'max_players',
        'total_questions',
        'started_at',
        'finished_at'
    ];

    // Relaciones
    public function players()
    {
        return $this->hasMany(GamePlayer::class);
    }

    public function answers()
    {
        return $this->hasMany(GameAnswer::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function winner()
    {
        return $this->belongsTo(User::class, 'winner_id');
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'game_questions', 'game_id', 'question_id');
    }
}

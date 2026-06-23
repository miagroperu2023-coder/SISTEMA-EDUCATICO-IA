<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'player_id',
        'question_id',
        'answer_id',
        'category_type',
        'correct',
        'time',
    ];

    // Relaciones
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function player()
    {
        return $this->belongsTo(GamePlayer::class, 'player_id');
    }

    // Relación dinámica según el tipo de categoría (igual que en Game)
    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class, 'answer_id');
    }
}

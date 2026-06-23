<?php

namespace App\Http\Controllers\Api\Preguntados;

use App\Http\Controllers\Controller;
use App\Models\Avatar;
use App\Models\Category;
use App\Models\Game;
use App\Models\GameAnswer;
use App\Models\GamePlayer;
use App\Models\GameQuestion;
use App\Models\Question;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PreguntadosController extends Controller
{
    /**
     * LOGIN DE USUARIO
     */
    public function login(Request $request)
    {
        $apiKey = $request->header('X-API-KEY');
        if ($apiKey !== 'login_preguntados') {
            return response()->json(['status' => 'error', 'message' => 'No autorizado'], 401);
        }

        /*$usuario = User::whereNotNull('phone')
            ->whereHas('subscriptions', function ($query) {
                $query->whereDate('ends_at', '>=', now());
            })
            ->where('study_id', $request->study_id)
            ->with('avatar')
            ->first();*/

        $input = trim($request->study_id);
        $usuario = User::where(function ($q) use ($input) {
            $q->where('email', $input);
                //->orWhere('email', $input);
        })->with('avatar')->first();

        if ($usuario) {
            $avatar = Avatar::where('user_id', $usuario->id)->first();

            if ($avatar) {
                return response()->json([
                    'status' => 'success',
                    'data' => $usuario,
                    'avatar' => $avatar
                ]);
            } else {
                return response()->json([
                    'status' => 'success',
                    'data' => $usuario,
                    'avatar' => 'sin datos'
                ]);
            }
        } else {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Usuario no encontrado o sin suscripción activa'
                ],
                404
            );
        }
    }



    /**
     * ESTADO DEL JUEGO
     */
    public function getGameStatus($gameId)
    {
        $game = Game::with('players.user')->findOrFail($gameId);
        return response()->json($game);
    }


    /**
     * CATEGORÍAS NORMALES Y SERUMS
     */
    public function categorias(Request $request)
    {
        $type = $request->input('type', 'question'); // 'question' o 'serums'

        $categories = $type === 'serums'
            ? Category::whereIn('id', [5, 6])->get()
            : Category::whereIn('id', [5, 6])->get();

        return response()->json($categories);
    }




    /**
     * CREAR PARTIDA
     */
    public function createGame(Request $request)
    {
        $game = Game::create([
            'code' => strtoupper(Str::random(6)),
            'type' => 'challenge',
            'status' => 'waiting',
            'creator_id' => $request->creator_id,
            'category_id' => $request->category_id,
            'category_type' => $request->category_type ?? 'question',
            'max_players' => $request->max_players,
            'total_questions' => $request->total_questions ?? 10,
        ]);

        GamePlayer::create([
            'game_id' => $game->id,
            'user_id' => $request->creator_id,
            'score' => 0,
            'finished' => false,
        ]);

        //seleccionando las preguntas segun la categoria
        $questions = Question::where('estado', 'activo')
            ->whereHas('section.course', function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            })
            //->with('answers') // si quieres respuestas
            ->inRandomOrder()
            ->take($game->total_questions)
            ->get();


        //guardanos los ids en la tabla pivot
        $game->questions()->attach($questions->pluck('id'));

        return response()->json([
            'message' => 'Partida creada correctamente.',
            'code' => $game->code,
            'game' => $game,
        ]);
    }



    /**
     * UNIRSE A PARTIDA EXISTENTE
     */
    public function joinGame(Request $request)
    {
        $game = Game::where('code', $request->code)->first();

        if (!$game) {
            return response()->json(['error' => 'Código de partida no válido'], 404);
        }

        // Verifica si ya se alcanzó el máximo de jugadores
        $playersCount = GamePlayer::where('game_id', $game->id)->count();
        if ($playersCount >= $game->max_players) {
            return response()->json(['error' => 'La partida ya está llena'], 403);
        }

        // Evitar duplicados
        if (GamePlayer::where('game_id', $game->id)->where('user_id', $request->user_id)->exists()) {
            return response()->json(['message' => 'Ya estás unido a esta partida.']);
        }

        // Agregar jugador
        GamePlayer::create([
            'game_id' => $game->id,
            'user_id' => $request->user_id,
            'score' => 0,
            'finished' => false,
        ]);

        // Si al unirse se llena la partida, cambia estado
        $playersCount++;
        if ($playersCount >= $game->max_players) {
            $game->update(['status' => 'active']);
        }

        return response()->json([
            'message' => 'Te uniste correctamente a la partida.',
            'game_id' => $game->id, //
            'game' => $game->load('players.user'),
        ]);
    }




    /**
     * Guardar respuesta del jugador
     */
    public function saveAnswer(Request $request)
    {
        $game = Game::findOrFail($request->game_id);
        $player = GamePlayer::where('game_id', $game->id)
            ->where('id', $request->player_id)
            ->firstOrFail();

        // Evita guardar la misma pregunta dos veces
        $exists = GameAnswer::where('game_id', $game->id)
            ->where('player_id', $player->id)
            ->where('question_id', $request->question_id)
            ->exists();

        if ($exists) {
            return response()->json(['success' => true, 'message' => 'Pregunta ya registrada previamente']);
        }

        $answer = GameAnswer::create([
            'game_id' => $game->id,
            'player_id' => $player->id,
            'question_id' => $request->question_id,
            'answer_id' => $request->answer_id ?? null, // puede ser null si tiempo se acaba
            'category_type' => $request->category_type,
            'correct' => $request->correct ?? false,
            'time' => $request->time ?? 15,
        ]);

        // Actualizar puntaje si es correcta
        if (!empty($request->correct) && $request->correct) {
            $player->increment('score');
        }

        return response()->json(['success' => true, 'answer' => $answer]);
    }

    /**
     * Obtener la siguiente pregunta
     */
    public function nextQuestion($gameId, $playerId)
    {
        $game = Game::findOrFail($gameId);
        $player = GamePlayer::findOrFail($playerId);

        // Si el juego ya terminó
        if ($game->status === 'finished') {
            return response()->json([
                'finished' => true,
                'message' => 'El juego ya ha terminado.',
            ]);
        }

        // Preguntas ya respondidas por este jugador
        $answeredQuestionIds = GameAnswer::where('game_id', $gameId)
            ->where('player_id', $playerId)
            ->pluck('question_id')
            ->toArray();

        // Todas las preguntas del juego
        $allQuestions = GameQuestion::where('game_id', $gameId)
            ->pluck('question_id')
            ->toArray();

        $remainingQuestions = array_diff($allQuestions, $answeredQuestionIds);

        // Si no quedan preguntas → jugador termina
        if (empty($remainingQuestions)) {

            //calculando el tiempo total(suma total 'time') 
            $totalTime = GameAnswer::where('game_id', $gameId)
                ->where('player_id', $playerId)
                ->sum('time');

            //actualizamos los campo de la tabla
            $player->update([
                'finished' => true,
                'status' => 'finished',
                'total_time' => $totalTime
            ]);

            // TERMINAR EL JUEGO para todos solo si no está terminado
            if ($game->status !== 'finished') {
                $game->update([
                    'status' => 'finished',
                    'winner_id' => $player->user_id,
                    'finished_at' => now(),
                ]);
            }

            return response()->json([
                'finished' => true,
                'message' => '¡Juego terminado! Has ganado porque terminaste primero.',
            ]);
        }

        // Tomar la primera pregunta pendiente para este jugador
        $nextQuestionId = array_values($remainingQuestions)[0];
        $nextQuestion = Question::with('answers')->findOrFail($nextQuestionId);

        return response()->json([
            'id' => $nextQuestion->id,
            'question' => $nextQuestion->titulo,
            'answers' => $nextQuestion->answers->map(fn($a) => [
                'id' => $a->id,
                'titulo' => $a->titulo,
                'es_correcta' => $a->es_correcta,
            ]),
        ]);
    }




    /**
     * CANTIDAD DE JUGADORES DE LA PARTIDA
     */
    public function players(Request $request)
    {
        $game_id = $request->game_id;
        $players = GamePlayer::with('user.avatar')->where('game_id', $game_id)->get();
        return response()->json(['players' => $players]);
    }

    /**
     * RESULTADOS DEL JUEGO
     */
    public function results($gameId)
    {
        $game = Game::findOrFail($gameId);
        $answers = GameAnswer::where('game_id', $gameId)
            ->with(['player.user'])
            ->get();

        if ($answers->isEmpty()) {
            return response()->json(['message' => 'No hay respuestas registradas para este juego'], 404);
        }

        $grouped = $answers->groupBy('player_id');

        $results = $grouped->map(function ($answersByPlayer) {
            $player = $answersByPlayer->first()->player;
            $user = $player->user;

            $correct = $answersByPlayer->where('correct', 1)->count();
            $incorrect = $answersByPlayer->where('correct', 0)->count();
            $total_time = $answersByPlayer->sum('time');

            return [
                'player_id' => $player->id,
                'user_id' => $user->id ?? null,
                'name' => $user->name ?? 'Sin nombre',
                'correct' => $correct,
                'incorrect' => $incorrect,
                'total_time' => $total_time,
            ];
        })->values();

        // Determinar correctamente el ganador
        $winner = $results->sort(function ($a, $b) {
            if ($a['correct'] != $b['correct']) {
                return $b['correct'] <=> $a['correct']; // más correctas primero
            }
            return $a['total_time'] <=> $b['total_time']; // si empatan, menor tiempo
        })->first();

        $game->update([
            'status' => 'finished',
            'winner_id' => $winner['user_id'],
            'finished_at' => now(),
        ]);

        // ACTUALIZAR PUNTAJES
        foreach ($results as $r) {
            $extra = ($r['user_id'] == $winner['user_id']) ? 50 : 0;

            GamePlayer::where('game_id', $gameId)
                ->where('user_id', $r['user_id'])
                ->update([
                    'score'      => $r['correct'] + $extra,   // <-- AQUÍ SE SUMAN LOS 50
                    'total_time' => $r['total_time'],
                    'status'     => 'finished',
                ]);
        }

        return response()->json([
            'results' => $results,
            'winner' => $winner,
        ]);
    }


    /**
     * PARA CONTAR CADA PREGUNTA DE CADA JUGADOR 
     */
    public function countAnswers($gameId)
    {
        $answers = GameAnswer::where('game_id', $gameId)
            ->with('player.user')
            ->get();

        $grouped = $answers->groupBy('player_id');

        $counts = $grouped->map(function ($answersByPlayer) {
            $player = $answersByPlayer->first()->player;
            return [
                'player_id' => $player->id,
                'name' => $player->user->name ?? 'Jugador',
                'answered' => $answersByPlayer->count(),
            ];
        })->values();

        return response()->json(['data' => $counts]);
    }
}

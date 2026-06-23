<?php

use App\Http\Controllers\Api\Preguntados\AvatarController;
use App\Http\Controllers\Api\Preguntados\PreguntadosController;
use App\Http\Controllers\Api\Preguntados\PreguntadosSingleController;
use App\Http\Controllers\Api\Preguntados\RankController;
use App\Http\Controllers\Api\Twilio\WhatsAppWebHookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//PRUEBAS AUTOMATICAS EN TWILIO
Route::post('/webhook/whatsapp', [WhatsAppWebHookController::class, 'handle'])->name('webhook.twilio');
Route::get('/webhook/whatsapp/questions', [WhatsAppWebHookController::class, 'questions'])->name('webhook.questions');


/** API PARA CONSUMO DE PREGUNTADOS **/
// Login
Route::post('/preguntados/login', [PreguntadosController::class, 'login'])->name('preguntados.login');

// juego modo unico
Route::get('/preguntados/questions/{categoryId}/{size}', [PreguntadosSingleController::class, 'index'])->name('preguntados.index');
Route::get('/preguntados/score/single/{user_id}/{correct}', [PreguntadosSingleController::class , 'saveScoreSingle'])->name('preguntados.score.single');


// Juego modo multijugador
Route::get('/preguntados/questions/categories', [PreguntadosController::class, 'categorias'])->name('preguntados.categorias');
Route::post('/preguntados/game/create', [PreguntadosController::class, 'createGame']);
Route::get('/preguntados/game/get/{gameId}', [PreguntadosController::class, 'getGameStatus']);
Route::get('/preguntados/questions/next/{gameId}/{playerId}', [PreguntadosController::class , 'nextQuestion']);
Route::post('/preguntados/game/join', [PreguntadosController::class, 'joinGame']);
Route::post('/preguntados/game/answer', [PreguntadosController::class, 'saveAnswer']);
Route::post('/preguntados/game/players', [PreguntadosController::class, 'players']);
Route::get('/preguntados/game/results/{gameId}', [PreguntadosController::class , 'results']);
Route::get('/preguntados/game/count/{gameId}', [PreguntadosController::class , 'countAnswers']);

//Avatar
Route::post('/preguntados/game/avatars', [AvatarController::class , 'store']);
Route::get('/preguntados/game/avatars/{user_id}', [AvatarController::class, 'show']);

//Rangos del juego
Route::get('/preguntados/game/rangos/{user_id}', [RankController::class, 'show']);
Route::get('/preguntados/game/ranking/top10', [RankController::class, 'topPlayers']);

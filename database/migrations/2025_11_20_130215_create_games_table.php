<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();

            // Tipo de partida: individual o reto
            $table->enum('type', ['single', 'challenge'])->default('single');

            // Estado general del juego
            $table->enum('status', ['waiting', 'active', 'finished'])->default('waiting');

            // Jugadores principales
            $table->foreignId('creator_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('winner_id')->nullable()->constrained('users')->onDelete('set null');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->enum('category_type', ['question', 'serums'])->default('question');
            $table->integer('max_players')->default(2);

            $table->unsignedInteger('total_questions')->default(10);
            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}

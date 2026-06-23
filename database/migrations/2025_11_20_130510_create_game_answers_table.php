<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained('games')->onDelete('cascade');
            $table->foreignId('player_id')->constrained('game_players')->onDelete('cascade');

            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('answer_id')->nullable();

            // Identifica el banco de preguntas (normal o serums)
            $table->enum('category_type', ['question', 'serums'])->default('question');

            $table->boolean('correct')->default(false);
            $table->float('time')->nullable();

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
        Schema::dropIfExists('game_answers');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameScoreSinglesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_score_singles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('score')->default(0);
            $table->integer('correct')->default(0);
            $table->integer('incorrect')->default(0);
            $table->integer('total_questions')->default(10);

            $table->integer('time_seconds')->nullable();
            $table->string('mode')->nullable();
            $table->string('match_uuid')->nullable();
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
        Schema::dropIfExists('game_score_singles');
    }
}

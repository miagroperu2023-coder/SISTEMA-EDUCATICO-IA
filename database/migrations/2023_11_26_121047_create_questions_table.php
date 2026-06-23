<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //SERAN EXAMENES DE 10 PREGUNTAS
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('titulo');
            $table->string('comentario')->nullable();
            $table->string('dificultad');
            $table->integer('puntos'); //2 PUNTOS POR CADA PREGUNTA
            $table->string('estado');
        
            // Clave foránea
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('user_id');
        
            // Restricción de clave foránea
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
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
        Schema::dropIfExists('questions');
    }
}

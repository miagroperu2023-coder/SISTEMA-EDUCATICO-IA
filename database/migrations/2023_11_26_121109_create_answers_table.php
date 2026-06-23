<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();

            // Columnas de la tabla
            $table->string('titulo');
            $table->boolean('es_correcta'); //TRUE O FALSE

            // Clave foránea
            $table->unsignedBigInteger('question_id');

            // Restricción de clave foránea
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');

            // Campos de tiempo
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
        Schema::dropIfExists('answers');
    }
}

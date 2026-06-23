<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_users', function (Blueprint $table) {
            $table->id();
            $table->string('calificacion')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('status')->nullable(); //APROBADO DESAPROBADO

            // Claves foráneas
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('exam_id');

            // Restricciones de clave foránea
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');

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
        Schema::dropIfExists('exam_users');
    }
}

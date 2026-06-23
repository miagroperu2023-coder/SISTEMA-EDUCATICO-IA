<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamUserAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_user_answers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('exam_user_id');
            $table->unsignedBigInteger('exam_question_id');
            $table->unsignedBigInteger('answer_id');

            // Restricción de clave foránea
            $table->foreign('exam_user_id')->references('id')->on('exam_users')->onDelete('cascade');
            $table->foreign('exam_question_id')->references('id')->on('exam_questions')->onDelete('cascade');
            $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade');

            $table->integer('puntos');

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
        Schema::dropIfExists('exam_user_answers');
    }
}

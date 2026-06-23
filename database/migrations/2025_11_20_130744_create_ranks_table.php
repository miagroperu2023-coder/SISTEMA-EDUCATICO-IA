<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ranks', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // "Aspirante Banquea"
            $table->string('slug')->unique(); // aspirante, estudiante, interno...
            $table->text('description')->nullable();
            $table->unsignedBigInteger('min_points')->default(0);
            $table->unsignedBigInteger('max_points')->nullable(); // null = infinito
            $table->string('avatar')->nullable(); // ruta / key al recurso visual
            $table->string('background')->nullable();
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
        Schema::dropIfExists('ranks');
    }
}

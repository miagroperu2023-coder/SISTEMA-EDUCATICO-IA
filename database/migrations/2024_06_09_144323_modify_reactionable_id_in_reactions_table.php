<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyReactionableIdInReactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reactions', function (Blueprint $table) {
            // Modificar el tipo de la columna 'reactionable_id' a 'unsignedBigInteger'
            $table->unsignedBigInteger('reactionable_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reactions', function (Blueprint $table) {
            // Revertir el cambio de 'reactionable_id' a 'unsignedInteger'
            $table->unsignedInteger('reactionable_id')->change();
        });
    }
}

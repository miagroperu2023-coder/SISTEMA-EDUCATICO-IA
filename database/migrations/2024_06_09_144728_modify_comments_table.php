<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments',  function (Blueprint $table) {
            // Agregar la columna 'content' y eliminar la columna 'name'
            $table->text('content')->after('id');
            $table->dropColumn('name');

            // Agregar nuevos campos
            $table->unsignedBigInteger('parent_id')->nullable()->after('commentable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            // Revertir los cambios: eliminar la columna 'content' y agregar la columna 'name'
            $table->dropColumn('content');
            $table->string('name')->after('id');

            // Eliminar los nuevos campos
            $table->dropColumn('parent_id');
        });
    }
}

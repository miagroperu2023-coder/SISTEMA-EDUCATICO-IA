<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pays', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade'); //foranea user 

            $table->string('collection_id')->nullable(); //LO TOMAREMOS COMO ID DEL CURSO
            $table->string('collection_status')->nullable();
            $table->string('payment_id')->nullable();
            $table->string('status')->nullable();
            $table->string('external_reference')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('merchant_order_id')->nullable();
            $table->string('preference_id')->nullable();
            $table->string('site_id')->nullable();
            $table->string('processing_mode')->nullable();
            $table->string('merchant_account_id')->nullable();
            $table->string('estado')->nullable();

            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();

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
        Schema::dropIfExists('pays');
    }
}

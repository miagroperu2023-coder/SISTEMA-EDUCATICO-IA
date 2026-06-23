<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('promo_code')->nullable();
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('name')->nullable();
            $table->integer('months')->nullable();
            $table->decimal('monthly_price', 8, 2)->nullable();
            $table->decimal('percentage', 5, 2)->nullable();
            $table->boolean('activo')->default(true);

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
        Schema::dropIfExists('plans');
    }
}

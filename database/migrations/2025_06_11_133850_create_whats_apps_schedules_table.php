<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhatsAppsSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('whats_apps_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('phone')->unique();   //51922394642
            $table->string('day')->nullable();   //martes
            $table->string('time')->nullable();  //15:30
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
        Schema::dropIfExists('whats_apps_schedules');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('professor_name');
            $table->string('professor_email');
            $table->string('asignature');
            $table->string('classroom');
            $table->boolean('video_beam');
            $table->boolean('cable_hdmi');
            $table->boolean('laptop');
            $table->boolean('electrical_extension');
            $table->boolean('adapter');
            $table->dateTime('reservation_start');
            $table->dateTime('reservation_end');
            $table->boolean('approved');
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
        Schema::dropIfExists('reservations');
    }
}

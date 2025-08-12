<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    public function up()
{
    Schema::create('reservas', function (Blueprint $table) {
        $table->id();
        $table->string('numero_reserva', 4)->unique(); // Lo mantenemos internamente
        $table->date('fecha');
        $table->time('hora_inicio');
        $table->time('hora_fin');
        $table->string('materia');
        $table->string('creador_username');
    });
}

    public function down()
    {
        Schema::dropIfExists('reservas');
    }
}
                         
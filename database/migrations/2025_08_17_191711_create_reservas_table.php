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
    $table->string('nombre_materia');
    $table->time('hora_inicio');
    $table->time('hora_fin');
    $table->enum('dia', ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes']);
    $table->string('tipo_origen');
    $table->enum('estado', ['pendiente', 'confirmada', 'cancelada'])->default('pendiente');
    $table->foreignId('aula_id')->constrained();
    $table->foreignId('horario_id')->nullable()->constrained();
    $table->timestamps();
});
// Tablas pivot para relaciones M:N
Schema::create('docente_materia', function (Blueprint $table) {
    $table->foreignId('docente_id')->constrained('users');
    $table->foreignId('materia_id')->constrained();
    $table->primary(['docente_id', 'materia_id']);
});

Schema::create('docente_reserva', function (Blueprint $table) {
    $table->foreignId('docente_id')->constrained('users');
    $table->foreignId('reserva_id')->constrained();
    $table->primary(['docente_id', 'reserva_id']);
});

Schema::create('materia_reserva', function (Blueprint $table) {
    $table->foreignId('materia_id')->constrained();
    $table->foreignId('reserva_id')->constrained();
    $table->primary(['materia_id', 'reserva_id']);
});
}

    public function down()
    {
        Schema::dropIfExists('reservas');
    }
}
                         
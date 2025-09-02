<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aula_id')->constrained('aulas')->cascadeOnDelete();
            $table->foreignId('materia_id')->constrained('materias')->cascadeOnDelete();
            $table->enum('dia', ['lunes','martes','miercoles','jueves','viernes']);
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->enum('tipo_origen', ['opcion1','opcion2'])->default('opcion1');
            $table->enum('trimestre', ['1er trimestre', '2do trimestre', '3er trimestre']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
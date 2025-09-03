<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->enum('dia', ['lunes', 'martes', 'miércoles', 'jueves', 'viernes']);
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->enum('turno', ['mañana', 'tarde']);
            $table->enum('trimestre', ['1er trimestre', '2do trimestre', '3er trimestre']);
            $table->string('curso'); // Ejemplo: "1A", "2B", etc.
            $table->boolean('necesita_reserva')->default(false);
            $table->timestamps();
            
            // Índices para optimizar consultas
            $table->index(['curso', 'trimestre', 'turno']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
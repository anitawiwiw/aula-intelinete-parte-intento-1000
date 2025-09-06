<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('historial_aires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aire_id')->constrained('aires')->cascadeOnDelete();
            $table->date('fecha')->nullable();
            $table->time('hora_inicio')->nullable();
            $table->time('hora_fin')->nullable();
            $table->float('temperatura')->nullable();
            $table->string('estado')->nullable(); // opcional: 'encendido','apagado', 'error'
            $table->json('payload')->nullable(); // guardamos JSON crudo del sensor si hace falta
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historial_aires');
    }
};

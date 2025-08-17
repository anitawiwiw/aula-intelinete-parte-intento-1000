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
       Schema::create('disponibilidades', function (Blueprint $table) {
    $table->id();
    $table->time('hora_inicio');
    $table->time('hora_fin');
    $table->enum('dia', ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes']);
    $table->enum('turno', ['mañana', 'tarde']);
    $table->enum('estado', ['libre', 'ocupado'])->default('libre');
    $table->foreignId('aula_id')->constrained();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disponibilidades');
    }
};

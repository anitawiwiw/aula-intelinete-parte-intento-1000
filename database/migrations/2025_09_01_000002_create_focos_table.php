<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('focos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->foreignId('aula_id')->nullable()->constrained('aulas')->nullOnDelete();
            $table->string('tipo'); // LED, Fluorescente, Emergencia
            $table->string('ubicacion')->nullable();
            $table->string('estado')->nullable(); // apagado, encendido, dañado, etc.
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('focos');
    }
};


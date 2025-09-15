<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historial_focos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('foco_id')->constrained('focos')->onDelete('cascade');
            $table->date('fecha')->nullable();
            $table->time('hora_inicio')->nullable();
            $table->time('hora_fin')->nullable();
            $table->integer('intensidad')->nullable(); // intensidad de luz
            $table->json('payload')->nullable(); // datos crudos enviados por ESP32
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historial_focos');
    }
};


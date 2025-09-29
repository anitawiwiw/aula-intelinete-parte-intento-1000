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
Schema::create('muebles', function (Blueprint $table) {
    $table->id();
    $table->string('nombre');
    $table->string('estado');
    $table->string('numero_inventario')->unique();
    $table->foreignId('aula_id')->constrained()->onDelete('cascade');
    $table->timestamps();

        });

        // Tabla pivote aula_mueble
        Schema::create('aula_mueble', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aula_id')->constrained('aulas')->onDelete('cascade');
            $table->foreignId('mueble_id')->constrained('muebles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aula_mueble');
        Schema::dropIfExists('muebles');
    }
};

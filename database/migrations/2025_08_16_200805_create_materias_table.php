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
        Schema::create('materias', function (Blueprint $table) {
    $table->id();
    $table->string('nombre');
    $table->string('carrera');
    $table->integer('año');
    $table->string('tipo_cursada');
    $table->timestamps();
    Schema::table('materias', function (Blueprint $table) {
    $table->boolean('es_conjunta')->default(false);
});
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materias');
    }
};

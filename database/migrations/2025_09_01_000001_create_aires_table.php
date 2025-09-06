<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('aires', function (Blueprint $table) {
            $table->id();
            // si ya tenés tabla aulas: relacion opcional
            $table->foreignId('aula_id')->nullable()->constrained('aulas')->nullOnDelete();
            $table->string('marca_modelo')->nullable();
            $table->string('ubicacion')->nullable(); // ej: "pared norte", "centro"
            $table->string('estado')->default('operativo'); // operativo, averiado, mantenimiento
            $table->date('ultima_mantenimiento')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aires');
    }
};

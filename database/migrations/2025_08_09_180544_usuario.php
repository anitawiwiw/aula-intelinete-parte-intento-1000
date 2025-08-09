<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // nombre real o completo
            $table->string('username')->unique(); // nombre de usuario único
            $table->string('email')->unique(); // correo único
            $table->string('password');
            $table->enum('role', ['profesor', 'administrador']); // rol elegido
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('users');
    }
};
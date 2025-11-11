<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocentesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('docentes')->insert([
            [
                'user_id' => null,
                'nombre_completo' => 'María López Fernández',
                'dni' => '30111222',
                'especialidad' => 'Matemática',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => null,
                'nombre_completo' => 'Carlos Pérez González',
                'dni' => '29455888',
                'especialidad' => 'Física',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => null,
                'nombre_completo' => 'Lucía Romero Díaz',
                'dni' => '31233444',
                'especialidad' => 'Química',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => null,
                'nombre_completo' => 'Javier Torres Muñoz',
                'dni' => '28777666',
                'especialidad' => 'Lengua y Literatura',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => null,
                'nombre_completo' => 'Sofía Herrera Castillo',
                'dni' => '29888999',
                'especialidad' => 'Historia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => null,
                'nombre_completo' => 'Andrés García Morales',
                'dni' => '30555111',
                'especialidad' => 'Informática',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

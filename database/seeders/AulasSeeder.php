<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AulasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('aulas')->insert([
            [
                'nombre' => 'Aula Maker',
                'ubicacion' => 1,
                'capacidad' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Laboratorio de Ciencias',
                'ubicacion' => 2,
                'capacidad' => 35,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Sala de Computación',
                'ubicacion' => 3,
                'capacidad' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Aula Inteligente',
                'ubicacion' => 4,
                'capacidad' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Taller de Robótica',
                'ubicacion' => 5,
                'capacidad' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Maker Lab Avanzado',
                'ubicacion' => 6,
                'capacidad' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

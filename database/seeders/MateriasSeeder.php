<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MateriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('materias')->insert([
            [
                'nombre' => 'Matemática I',
                'carrera' => 'Ingeniería Informática',
                'año' => '1°',
                'tipo_cursada' => 'Anual',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Programación I',
                'carrera' => 'Ingeniería Informática',
                'año' => '1°',
                'tipo_cursada' => 'Cuatrimestral',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Física General',
                'carrera' => 'Ingeniería Electrónica',
                'año' => '1°',
                'tipo_cursada' => 'Anual',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Bases de Datos',
                'carrera' => 'Ingeniería Informática',
                'año' => '2°',
                'tipo_cursada' => 'Cuatrimestral',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Historia del Arte',
                'carrera' => 'Diseño Gráfico',
                'año' => '2°',
                'tipo_cursada' => 'Anual',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Inteligencia Artificial',
                'carrera' => 'Ingeniería Informática',
                'año' => '4°',
                'tipo_cursada' => 'Cuatrimestral',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

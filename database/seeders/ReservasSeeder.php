<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reservas')->insert([
            [
                'aula_id' => 1,
                'materia_id' => 1,
                'dia' => 'lunes',
                'hora_inicio' => '07:00',
                'hora_fin' => '07:40',
                'tipo_origen' => 'opcion1',
                'trimestre' => '1er trimestre',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'aula_id' => 2,
                'materia_id' => 2,
                'dia' => 'martes',
                'hora_inicio' => '08:25',
                'hora_fin' => '09:05',
                'tipo_origen' => 'opcion1',
                'trimestre' => '1er trimestre',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'aula_id' => 3,
                'materia_id' => 3,
                'dia' => 'miercoles',
                'hora_inicio' => '09:50',
                'hora_fin' => '10:30',
                'tipo_origen' => 'opcion2',
                'trimestre' => '1er trimestre',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'aula_id' => 4,
                'materia_id' => 4,
                'dia' => 'jueves',
                'hora_inicio' => '11:15',
                'hora_fin' => '11:55',
                'tipo_origen' => 'opcion1',
                'trimestre' => '1er trimestre',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'aula_id' => 5,
                'materia_id' => 5,
                'dia' => 'viernes',
                'hora_inicio' => '07:40',
                'hora_fin' => '08:15',
                'tipo_origen' => 'opcion2',
                'trimestre' => '1er trimestre',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'aula_id' => 6,
                'materia_id' => 6,
                'dia' => 'lunes',
                'hora_inicio' => '11:55',
                'hora_fin' => '12:30',
                'tipo_origen' => 'opcion1',
                'trimestre' => '1er trimestre',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

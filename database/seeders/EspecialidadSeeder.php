<?php

namespace Database\Seeders;

use App\Models\Especialidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EspecialidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Especialidad::create([
            'nombre' => 'Psicologia',
            'descripcion' => '',
        ]);

        Especialidad::create([
            'nombre' => 'Odontologia',
            'descripcion' => '',
        ]);
    }
}

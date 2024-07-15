<?php

namespace Database\Seeders;

use App\Models\Especialidad;
use App\Models\HorarioAtencion;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SuperAdminSeeder::class,
            EspecialidadSeeder::class,
            PacienteSeeder::class,
            HorarioAtencionSeeder::class,
            EspecialistaSeeder::class,
            CitaSeeder::class
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\HorarioAtencion;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HorarioAtencionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HorarioAtencion::create([
            'hora_inicio' => '08:00:00',
            'hora_fin' => '12:00:00',
            'estado' => true,
        ]);

        HorarioAtencion::create([
            'hora_inicio' => '14:00:00',
            'hora_fin' => '18:00:00',
            'estado' => true,
        ]);
    }
}

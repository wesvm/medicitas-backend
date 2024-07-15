<?php

namespace Database\Seeders;

use App\Models\Cita;
use App\Models\Especialista;
use App\Models\HorarioAtencion;
use App\Models\Paciente;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $pacientes = Paciente::all();
        $especialistas = Especialista::all();

        $horarios = [
            ['inicio' => '08:00', 'fin' => '11:00'],
            ['inicio' => '14:00', 'fin' => '17:00'],
        ];

        $fechaInicio = '2024-01-01';
        $fechaFin = '2024-05-01';

        $fecha = $fechaInicio;

        while ($fecha <= $fechaFin) {
            foreach ($horarios as $horario) {
                $horaInicio = $horario['inicio'];
                $horaFin = $horario['fin'];

                $hora = $horaInicio;
                while ($hora < $horaFin) {
                    // Seleccionar un paciente y especialista aleatorio
                    $paciente = $pacientes->random();
                    $especialista = $especialistas->random();

                    // Crear cita
                    Cita::create([
                        'paciente_id' => $paciente->user_id,
                        'especialista_id' => $especialista->user_id,
                        'fecha' => $fecha,
                        'hora' => $hora . ':00',
                        'motivo' => $faker->sentence,
                        'estado' => 'programada'
                    ]);

                    // Incrementar hora (una hora de diferencia)
                    $hora = date('H:00', strtotime($hora . '+1 hour'));
                }
            }

            // Incrementar fecha
            $fecha = date('Y-m-d', strtotime($fecha . '+1 day'));
        }
    }
}

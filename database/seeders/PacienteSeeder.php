<?php

namespace Database\Seeders;

use App\Models\Paciente;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $escuelas = [
            'Ingenieria de Sistemas e Informatica',
            'Ingenieria de Minas',
            'Ingenieria Ambiental',
            'Ingenieria Agroindustrial',
            'Ingenieria Pesquera',
            'Ingenieria Civil',
            'Derecho',
            'Medicina',
            'Administracion',
            'Contabilidad',
            'Gestion Publica y Desarrollo Social',

        ];
        $tiposSeguro = ['SIS', 'ESSALUD'];

        foreach (range(1, 100) as $index) {
            $user = User::create([
                'dni' => $faker->unique()->numerify('########'),
                'password' => bcrypt('password'),
                'email' => $faker->unique()->safeEmail,
                'rol' => 'paciente'
            ]);

            $esEstudiante = $faker->boolean;

            Paciente::create([
                'user_id' => $user->id,
                'nombres' => $faker->firstName,
                'apellidos' => $faker->lastName,
                'edad' => $faker->numberBetween(18, 40),
                'fecha_nacimiento' => $faker->date(),
                'lugar_nacimiento' => $faker->city,
                'domicilio' => $faker->address,
                'telefono' => $faker->phoneNumber,
                'escuela_profesional' => $esEstudiante ? $faker->randomElement($escuelas) : null,
                'ocupacion' => $esEstudiante ? null : $faker->jobTitle,
                'tipo_seguro' => $faker->randomElement($tiposSeguro),
                'telefono_emergencia' => $faker->phoneNumber,
            ]);
        }
    }
}

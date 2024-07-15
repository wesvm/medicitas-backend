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
            ['nombre' => 'Ingenieria de Sistemas e Informatica'],
            ['nombre' => 'Ingenieria de Minas'],
            ['nombre' => 'Ingenieria Ambiental'],
            ['nombre' => 'Ingenieria Agroindustrial'],
            ['nombre' => 'Ingenieria Pesquera'],
            ['nombre' => 'Ingenieria Civil'],
            ['nombre' => 'Derecho'],
            ['nombre' => 'Medicina'],
            ['nombre' => 'Administracion'],
            ['nombre' => 'Contabilidad'],
            ['nombre' => 'Gestion Publica y Desarrollo Social'],
        ];

        $tiposSeguro = ['SIS', 'ESSALUD'];

        foreach (range(1, 10) as $index) {

            $dni = $faker->unique()->numerify('########');
            $user = User::create([
                'dni' => $dni,
                'password' => bcrypt($dni),
                'email' => $faker->unique()->safeEmail,
                'rol' => 'paciente'
            ]);

            $esEstudiante = $faker->boolean;

            $escuela = $esEstudiante ? $faker->randomElement($escuelas) : null;

            Paciente::create([
                'user_id' => $user->id,
                'nombres' => $faker->firstName,
                'apellidos' => $faker->lastName,
                'edad' => $faker->numberBetween(18, 40),
                'fecha_nacimiento' => $faker->date(),
                'lugar_nacimiento' => $faker->city,
                'domicilio' => $faker->address,
                'telefono' => $faker->phoneNumber,
                'escuela_profesional' => $escuela ? $escuela['nombre'] : null,
                'ocupacion' => $esEstudiante ? null : $faker->jobTitle,
                'tipo_seguro' => $faker->randomElement($tiposSeguro),
                'telefono_emergencia' => $faker->phoneNumber,
            ]);
        }
    }
}

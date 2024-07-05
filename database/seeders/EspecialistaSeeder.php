<?php

namespace Database\Seeders;

use App\Models\Especialista;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EspecialistaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $dni = $faker->unique()->numerify('########');
        $user = User::create([
            'dni' => $dni,
            'password' => bcrypt($dni),
            'email' => $faker->unique()->safeEmail,
            'rol' => 'especialista'
        ]);

        Especialista::create([
            'user_id' => $user->id,
            'nombres' => $faker->firstName,
            'apellidos' => $faker->lastName,
            'telefono' => $faker->phoneNumber,
            'especialidad_id' => 1,
            'horario_atencion_id' => 1,
        ]);


        //--------------

        $dni = $faker->unique()->numerify('########');
        $user = User::create([
            'dni' => $dni,
            'password' => bcrypt($dni),
            'email' => $faker->unique()->safeEmail,
            'rol' => 'especialista'
        ]);

        Especialista::create([
            'user_id' => $user->id,
            'nombres' => $faker->firstName,
            'apellidos' => $faker->lastName,
            'telefono' => $faker->phoneNumber,
            'especialidad_id' => 2,
            'horario_atencion_id' => 2,
        ]);
    }
}

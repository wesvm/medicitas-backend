<?php

namespace Database\Seeders;

use App\Models\Administrador;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'dni' => '76543210',
            'password' => Hash::make('admin'),
            'email' => 'samuelwalter2001@gmail.com',
            'rol' => 'admin',
        ]);

        Administrador::create([
            'user_id' => $admin->id,
            'nombres' => 'Administrador',
            'apellidos' => '',
            'telefono' => '987654321'
        ]);
    }
}

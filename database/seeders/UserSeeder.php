<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Administrador',
            'email'    => 'admin@crm.com',
            'password' => Hash::make('password'),
            'rol'      => 'admin',
        ]);

        User::create([
            'name'     => 'Usuario Normal',
            'email'    => 'usuario@crm.com',
            'password' => Hash::make('password'),
            'rol'      => 'usuario',
        ]);
    }
}

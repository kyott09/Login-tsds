<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario administrador
        $admin = User::create([
            'name' => 'Tobias',
            'email' => 'tobias@contratista.com',
            'password' => Hash::make('12345678'),
            'prioridad' => 'premium',
        ]);
        $admin->assignRole('admin');

        // Usuario empleado
        $empleado = User::create([
            'name' => 'Aquino',
            'email' => 'aquino@contratista.com',
            'password' => Hash::make('12345678'),
            'prioridad' => 'basico',
        ]);
        $empleado->assignRole('empleado');

        // Usuario cliente 1
        $cliente1 = User::create([
            'name' => 'Lucas',
            'email' => 'lucas@contratista.com',
            'password' => Hash::make('87654321'),
            'prioridad' => 'premium',
        ]);
        $cliente1->assignRole('cliente');

        // Usuario cliente 2
        $cliente2 = User::create([
            'name' => 'Martina',
            'email' => 'martina@contratista.com',
            'password' => Hash::make('11223344'),
            'prioridad' => 'basico',
        ]);
        $cliente2->assignRole('cliente');
    }
}

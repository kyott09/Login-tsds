<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usuario administrador
        $admin = User::create([
            'name' => 'tobias',
            'email' => 'tobias@contratista.com',
            'password' => Hash::make('12345678'),

        ]);
        $admin->assignRole('admin');

        // Usuario empleado
        $empleado = User::create([
            'name' => 'aquino',
            'email' => 'aquino@contratista.com',
            'password' => Hash::make('12345678'),

        ]);
        $empleado->assignRole('empleado');

        // Usuario cliente 1
        $cliente1 = User::create([
            'name' => 'lucas',
            'email' => 'lucas@contratista.com',
            'password' => Hash::make('87654321'),
        ]);
        $cliente1->assignRole('cliente');

        // Usuario cliente 2
        $cliente2 = User::create([
            'name' => 'martina',
            'email' => 'martina@contratista.com',
            'password' => Hash::make('11223344'),
        ]);
        $cliente2->assignRole('cliente');
    }
}
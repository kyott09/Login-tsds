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
    }
}
<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition()
    {
        // Crear el usuario normalmente (sin intentar insertar 'role')
        $user = User::factory()->create();

        // Asignar el rol "empleado" al usuario usando Spatie Laravel Permission
        $user->assignRole('empleado');

        return [
            'user_id' => $user->id, // Usa el ID del usuario creado
            'vehicle_id' => Vehicle::inRandomOrder()->first()?->id ?? Vehicle::factory(),
            'fecha_ingreso' => $this->faker->date(),
            'skills' => $this->faker->words(3, true),
            'estado_laboral' => $this->faker->randomElement(['activo', 'licencia', 'baja']),
            'fecha_inicio_licencia' => null,
            'fecha_fin_licencia' => null,
        ];
    }
}
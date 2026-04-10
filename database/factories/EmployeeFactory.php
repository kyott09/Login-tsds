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
        $faker = \Faker\Factory::create('es_AR');

        $user = User::factory()->create();
        $user->assignRole('empleado');

        return [
            'user_id' => $user->id,
            'vehicle_id' => Vehicle::inRandomOrder()->first()?->id ?? Vehicle::factory(),
            'fecha_ingreso' => $faker->date(),
            'skills' => $faker->words(3, true),
            'estado_laboral' => $faker->randomElement(['activo', 'licencia', 'baja']),
            'fecha_inicio_licencia' => null,
            'fecha_fin_licencia' => null,
        ];
    }
}
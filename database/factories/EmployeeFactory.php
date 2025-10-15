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
        return [
            'user_id' => User::factory(),
            'vehicle_id' => Vehicle::inRandomOrder()->first()?->id ?? Vehicle::factory(),
            'fecha_ingreso' => $this->faker->date(),
            'skills' => $this->faker->words(3, true),
            'estado_laboral' => $this->faker->randomElement(['activo', 'licencia', 'baja']),
            'fecha_inicio_licencia' => null,
            'fecha_fin_licencia' => null,
        ];
    }
}

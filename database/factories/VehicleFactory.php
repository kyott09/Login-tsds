<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'patente' => strtoupper($this->faker->bothify('??###??')),
            'marca' => $this->faker->word,
            'modelo' => $this->faker->word,
            'color' => $this->faker->word,
            'anio' => $this->faker->numberBetween(2000, 2024),
            'placa' => $this->faker->word,
            'tipo' => $this->faker->word,
            'estado' => $this->faker->word,
            'usuario' => $this->faker->word,
            'email' => $this->faker->word,
            'telefono' => $this->faker->word,
            'direccion' => $this->faker->word,
            'ciudad' => $this->faker->word,
            'provincia' => $this->faker->word,
            'pais' => $this->faker->word,
            'observaciones' => $this->faker->word,
            'created_at' => $this->faker->dateTime,
            'updated_at' => $this->faker->dateTime,
        ];
    }
}

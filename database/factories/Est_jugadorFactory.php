<?php

// database/factories/EstJugadorFactory.php

namespace Database\Factories;
use App\Models\Est_jugador;

use Illuminate\Database\Eloquent\Factories\Factory;

class EstJugadorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'goles' => $this->faker->numberBetween(0, 30),
            'asistencias' => $this->faker->numberBetween(0, 20),
            'amarillas' => $this->faker->numberBetween(0, 10),
            'rojas' => $this->faker->numberBetween(0, 3),
            'jugador_id' => $this->faker->unique()->numberBetween(1, 30) // Asegura relación uno a uno si es necesario
        ];
    }
}

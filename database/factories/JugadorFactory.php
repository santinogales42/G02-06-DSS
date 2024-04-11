<?php

// database/factories/JugadorFactory.php

namespace Database\Factories;
use App\Models\Est_jugador;
use App\Models\Jugador;

use Illuminate\Database\Eloquent\Factories\Factory;

class JugadorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->name,
            'posicion' => $this->faker->randomElement(['Delantero', 'Mediocampista', 'Defensor', 'Portero']),
            'nacionalidad' => $this->faker->country,
            'edad' => $this->faker->numberBetween(18, 40),
            'equipo_id' => $this->faker->numberBetween(1, 2), // Asegúrate de que estos ID de equipo existen o ajusta según tus datos
            'foto' => $this->faker->imageUrl(640, 480, 'sports'),
            'biografia' => $this->faker->text
        ];
    }
}

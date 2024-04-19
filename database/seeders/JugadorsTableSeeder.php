<?php

// database/seeders/JugadorSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jugador;
use App\Models\Est_jugador;

class JugadorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jugador::insert([
            [
                'nombre' => 'Cristiano Ronaldo',
                'posicion' => 'Delantero',
                'nacionalidad' => 'Portugal',
                'edad' => 35,
                'equipo_id' => 1,
                'foto' => 'images/jugadores/cr7.webp',  // Ruta relativa desde la carpeta public
                'biografia' => 'Cristiano Ronaldo, conocido simplemente como CR7, es uno de los futbolistas más famosos y condecorados del mundo. Ha ganado múltiples títulos y premios individuales en su carrera.'
            ],
            [
                'nombre' => 'Lionel Messi',
                'posicion' => 'Delantero',
                'nacionalidad' => 'Argentina',
                'edad' => 33,
                'equipo_id' => 2,
                'foto' => 'images/jugadores/messi.png',  // Ruta relativa desde la carpeta public
                'biografia' => 'Lionel Messi es ampliamente considerado como uno de los mejores jugadores de todos los tiempos, conocido por su habilidad, visión de juego y goles espectaculares. Ha pasado la mayor parte de su carrera en el FC Barcelona.'
            ]
        ]); 
        Jugador::factory(30)->create()->each(function ($jugador) {
            
            
        });
        
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Jugador;
class JugadorsTableSeeder extends Seeder
{
   
public function run(){
        Jugador::insert([
            [
                'nombre' => 'Lionel Messi',
                'posicion' => 'Delantero',
                'nacionalidad' => 'Argentina',
                'edad' => 34,
                'equipo_id' => 1,
                'foto' => 'images/jugadores/messi.png',
                'biografia' => 'Lionel Messi, considerado uno de los mejores futbolistas de todos los tiempos, ha dejado una marca imborrable en el mundo del fútbol con su habilidad inigualable, visión de juego y precisión en el campo. Nacido en Rosario, Argentina, su carrera profesional despegó en el FC Barcelona, donde ganó numerosos títulos, incluyendo 4 Ligas de Campeones de la UEFA y 10 títulos de La Liga. Conocido por su humildad fuera del campo y su magia dentro de él, Messi continúa asombrando al mundo con su juego en el Paris Saint-Germain y la selección argentina, con la que ganó la Copa América 2021.'
            ],
            [
                'nombre' => 'Cristiano Ronaldo',
                'posicion' => 'Delantero',
                'nacionalidad' => 'Portugal',
                'edad' => 36,
                'equipo_id' => 2,
                'foto' => 'images/jugadores/cr7.webp',
                'biografia' => 'Cristiano Ronaldo es un icono global del fútbol, conocido tanto por su impresionante físico como por su excepcional talento en el campo. Nacido en Madeira, Portugal, ha jugado en algunos de los clubes más prestigiosos del mundo, incluyendo el Sporting de Lisboa, Manchester United, Real Madrid, y Juventus. Con 5 Balones de Oro a su nombre, Ronaldo ha establecido numerosos récords, entre ellos el máximo goleador de todos los tiempos en la Liga de Campeones de la UEFA. Además de sus logros con los clubes, ha liderado a la selección portuguesa a la victoria en la Eurocopa 2016 y la Liga de Naciones de la UEFA en 2019, consolidando su legado como uno de los grandes del deporte.'
            ]
        ]);
}}

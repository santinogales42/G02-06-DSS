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
        
        Jugador::factory(30)->create()->each(function ($jugador) {
            // Asumiendo que cada jugador tiene una estadística única
            
        });
    }
}

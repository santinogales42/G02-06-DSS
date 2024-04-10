<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Jugador;
class JugadorsTableSeeder extends Seeder
{
   
    public function run()
    {
        Jugador::factory()->count(30)->create();
    }
}

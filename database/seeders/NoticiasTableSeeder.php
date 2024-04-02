<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Noticia;
use Carbon\Carbon;
class NoticiasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Noticia::create([
        'fecha' => now(),
        'link_de_la_web' => 'https://ejemplo.com/noticia1',
        'titulo' => 'Noticia Importante 1',
        'enlace_de_la_foto' => 'https://ejemplo.com/imagen1.jpg',
        'contenido' => 'Contenido de la noticia importante 1.',
        'autor' => 'Autor 1',
        'equipo_id' => 1, // Asegúrate de que este ID exista en tu tabla `equipos`
    ]);

    // Repite el proceso para más noticias
    Noticia::create([
        'fecha' => now()->addDay(1),
        'link_de_la_web' => 'https://ejemplo.com/noticia2',
        'titulo' => 'Noticia Importante 2',
        'enlace_de_la_foto' => 'https://ejemplo.com/imagen2.jpg',
        'contenido' => 'Contenido de la noticia importante 2.',
        'autor' => 'Autor 2',
        'equipo_id' => 1, // Asume que este ID también existe en tu tabla `equipos`
    ]);

            
        
    }
}

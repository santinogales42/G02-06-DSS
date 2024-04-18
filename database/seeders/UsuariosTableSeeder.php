<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Usuario;
use Faker\Factory as Faker;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Usuario::insert([
            [
                'nombre' => 'JuaPérez',
                'correo' => 'jezhola123@example.com',
                'contraseña' => '12345678'
            ], [
                'nombre' => 'Manolo',
                'correo' => 'manolo@gmail.com',
                'contraseña' => 'manolo1234'
            ],[
                'nombre' => 'Lola',
                'correo' => 'lolita123@gmail.com',
                'contraseña' => 'lokita123456'
            ]
        ]);
    }
}

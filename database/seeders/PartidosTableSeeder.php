<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Partido;
use Carbon\Carbon;
class PartidosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Partido::insert([
            [
                'fecha' => Carbon::create('2023', '08', '11')->format('Y-m-d'),
                'hora' => Carbon::createFromTimeString('19:30:00')->format('H:i:s'),
                'estadio' => 'Power Horse Stadium',
                'resultado' => '0-2',
                'jornada' => 1,
                'equipo_local_id' => 20,
                'equipo_visitante_id' => 16
            ],
            [
                'fecha' => Carbon::create('2023', '08', '11')->format('Y-m-d'),
                'hora' => Carbon::createFromTimeString('22:00:00')->format('H:i:s'),
                'estadio' => 'Ramón Sánchez-Pizjuán',
                'resultado' => '1-2',
                'jornada' => 1,
                'equipo_local_id' => 14,
                'equipo_visitante_id' => 7
            ],
            [
                'fecha' => Carbon::create('2023', '08', '12')->format('Y-m-d'),
                'hora' => Carbon::createFromTimeString('17:00:00')->format('H:i:s'),
                'estadio' => 'Anoeta',
                'resultado' => '1-1',
                'jornada' => 1,
                'equipo_local_id' => 6,
                'equipo_visitante_id' => 3
            ],
            [
                'fecha' => Carbon::create('2023', '08', '12')->format('Y-m-d'),
                'hora' => Carbon::createFromTimeString('19:30:00')->format('H:i:s'),
                'estadio' => 'Gran Canaria',
                'resultado' => '1-1',
                'jornada' => 1,
                'equipo_local_id' => 12,
                'equipo_visitante_id' => 15
            ],
            [
                'fecha' => Carbon::create('2023', '08', '12')->format('Y-m-d'),
                'hora' => Carbon::createFromTimeString('21:30:00')->format('H:i:s'),
                'estadio' => 'San Mamés',
                'resultado' => '0-2',
                'jornada' => 1,
                'equipo_local_id' => 5,
                'equipo_visitante_id' => 1
            ],
            [
                'fecha' => Carbon::create('2023', '08', '13')->format('Y-m-d'),
                'hora' => Carbon::createFromTimeString('17:00:00')->format('H:i:s'),
                'estadio' => 'Balaídos',
                'resultado' => '0-2',
                'jornada' => 1,
                'equipo_local_id' => 17,
                'equipo_visitante_id' => 9
            ],
            [
                'fecha' => Carbon::create('2023', '08', '13')->format('Y-m-d'),
                'hora' => Carbon::createFromTimeString('19:30:00')->format('H:i:s'),
                'estadio' => 'Cerámica',
                'resultado' => '1-2',
                'jornada' => 1,
                'equipo_local_id' => 10,
                'equipo_visitante_id' => 8
            ],
            [
                'fecha' => Carbon::create('2023', '08', '13')->format('Y-m-d'),
                'hora' => Carbon::createFromTimeString('21:30:00')->format('H:i:s'),
                'estadio' => 'Coliseum',
                'resultado' => '0-0',
                'jornada' => 1,
                'equipo_local_id' => 11,
                'equipo_visitante_id' => 2
            ],
            [
                'fecha' => Carbon::create('2023', '08', '14')->format('Y-m-d'),
                'hora' => Carbon::createFromTimeString('19:30:00')->format('H:i:s'),
                'estadio' => 'Nuevo Mirandilla',
                'resultado' => '1-0',
                'jornada' => 1,
                'equipo_local_id' => 18,
                'equipo_visitante_id' => 13
            ],
            [
                'fecha' => Carbon::create('2023', '08', '14')->format('Y-m-d'),
                'hora' => Carbon::createFromTimeString('21:30:00')->format('H:i:s'),
                'estadio' => 'Civitas Metropolitano',
                'resultado' => '3-1',
                'jornada' => 1,
                'equipo_local_id' => 4,
                'equipo_visitante_id' => 19
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('admin1234')
            ],
            [
                'name' => 'prueba',
                'email' => 'prueba@example.com',
                'password' => bcrypt('prueba1234')
            ]
        ]);

        User::factory()->count(4)->create();
    }
}

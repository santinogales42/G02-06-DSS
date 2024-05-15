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
                'password' => bcrypt('admin1234'),
                'isAdmin'=>true
            ],
            [
                'name' => 'admin2',
                'email' => 'admin2@example.com',
                'password' => bcrypt('admin12345'),
                'isAdmin'=>true
            ],
            [
                'name' => 'prueba',
                'email' => 'prueba@example.com',
                'password' => bcrypt('prueba1234'),
                'isAdmin' => false
            ]
        ]);

        User::factory()->count(9)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id_user' => '1',
            'nama_depan' => 'admin',
            'nama_belakang' => 'admin',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'id_user' => '2',
            'nama_depan' => 'Marcelina',
            'nama_belakang' => 'Alicia',
            'email' => 'user@gmail.com',
            'username' => 'user',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'id_user' => '3',
            'nama_depan' => 'Sarmida',
            'nama_belakang' => 'Sihombing',
            'email' => 'user0@gmail.com',
            'username' => 'user0',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}

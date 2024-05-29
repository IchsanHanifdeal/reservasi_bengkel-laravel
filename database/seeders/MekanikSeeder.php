<?php

namespace Database\Seeders;

use App\Models\Mekanik;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MekanikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mekanik::create([
            'nama_mekanik' => 'Ujang'
        ]);

        Mekanik::create([
            'nama_mekanik' => 'Udin'
        ]);

        Mekanik::create([
            'nama_mekanik' => 'Zubaidah'
        ]);
    }
}

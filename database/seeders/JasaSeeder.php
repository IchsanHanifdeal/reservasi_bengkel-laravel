<?php

namespace Database\Seeders;

use App\Models\Jasa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JasaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jasa::create([
            'nama_jasa' => 'Perbaikan Di Rumah',
            'id_mekanik' => '1',
            'harga' => '100000',
        ]);

        Jasa::create([
            'nama_jasa' => 'Perbaikan Di Tempat',
            'id_mekanik' => '1',
            'harga' => '50000',
        ]);
    }
}

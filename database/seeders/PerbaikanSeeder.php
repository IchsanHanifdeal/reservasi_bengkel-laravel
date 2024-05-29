<?php

namespace Database\Seeders;

use App\Models\Perbaikan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerbaikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Perbaikan::create([
            'id_user' => '3',
            'nama_mobil' => 'Toyota Raize',
            'plat_mobil' => 'BM 0000 CB',
            'no_whatsapp' => '6285835522698',
            'tentang_kerusakan' => 'coba coba',
            'id_mekanik' => '2',
            'tanggal_mulai' => now(),
            'status' => 'sudah selesai',
            'tanggal_selesai' => now(),
            'harga_total' => '100000',
        ]);
    }
}

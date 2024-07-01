<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::create([
            'nama_item' => 'Oli',
            'stok' => '3',
            'harga' => '35000',
        ]);

        Item::create([
            'nama_item' => 'Kampas Rem',
            'stok' => '5',
            'harga' => '35000',
        ]);

        Item::create([
            'nama_item' => 'Bosh',
            'stok' => '35',
            'harga' => '35000',
        ]);
    }
}

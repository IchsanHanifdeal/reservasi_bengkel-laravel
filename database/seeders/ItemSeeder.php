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
            'harga' => '35000',
        ]);

        Item::create([
            'nama_item' => 'Kampas Rem',
            'harga' => '35000',
        ]);

        Item::create([
            'nama_item' => 'Bosh',
            'harga' => '35000',
        ]);
    }
}

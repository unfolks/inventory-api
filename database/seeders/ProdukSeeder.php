<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Produk::create([
            'nama_produk' => 'Kabel LAN',
            'kode_produk' => 'PRD001',
            'kategori' => 'Elektronik',
            'satuan' => 'Unit'
        ]);
        Produk::create([
            'nama_produk' => 'Mouse',
            'kode_produk' => 'PRD002',
            'kategori' => 'Aksesoris',
            'satuan' => 'Unit'
        ]);
    }
}

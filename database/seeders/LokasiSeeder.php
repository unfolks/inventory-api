<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lokasi;

class LokasiSeeder extends Seeder
{
    public function run()
    {
        Lokasi::create([
            'kode_lokasi' => 'LOC001',
            'nama_lokasi' => 'Gudang Utama'
        ]);
        Lokasi::create([
            'kode_lokasi' => 'LOC002',
            'nama_lokasi' => 'Cabang 1'
        ]);
    }
}

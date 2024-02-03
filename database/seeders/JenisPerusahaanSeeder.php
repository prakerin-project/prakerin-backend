<?php

namespace Database\Seeders;

use App\Models\JenisPerusahaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisPerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis = ['Teknologi', 'Kesehatan', 'Keuangan', 'Hiburan', 'Game', 'Otomotif'];

        foreach ($jenis as $j) {
            JenisPerusahaan::create([
                'nama' => $j
            ]);
        }
    }
}

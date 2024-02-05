<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jurusan = ['Rekayasa Perangkat Lunak', 'Teknik Komputer Jaringan', 'Multimedia', 'Akuntansi', 'Teknik Pemesinan', 'Teknik Kendaraan Ringan', 'Teknik Pengelasan', 'Beautique Busana'];

        $akronim = ['RPL', 'TKJ', 'MM', 'AK', 'TP', 'TKR', 'TPL', 'BB'];

        for ($i = 0; $i < 8; $i++)
        {
            \App\Models\Jurusan::create([
                'nama_jurusan' => $jurusan[$i],
                'akronim'      => $akronim[$i],
            ]);
        }
    }
}

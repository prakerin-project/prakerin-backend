<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;
use Hash;
use DB;

class DatabaseSeeder extends Seeder
{
    protected const ROLES = ['hubin', 'walas', 'tu', 'siswa', 'pembimbing', 'pembimbing', 'kaprog'];
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* -------------------------------- SEED USER ------------------------------- */
        foreach ($this::ROLES as $role) {
            \App\Models\User::factory()->create([
                'id'       => Str::uuid(),
                'password' => Hash::make('123'),
                'role'     => $role,
                'username' => fake('id_ID')->userName()
            ]);
        }

        /* -------------------------- SEED JENISPERUSAHAAN -------------------------- */
        $this->call(JenisPerusahaanSeeder::class);

        /* ------------------------------ SEED JURUSAN ------------------------------ */
        $this->call(JurusanSeeder::class);

        /* ------------------------------ SEED HUBIN ----------------------------- */
        \App\Models\Hubin::factory()->create([
            'nip'           => rand(10000000, 9999999999),
            'nama'          => fake('id_ID')->name(),
            'id_user'       => DB::table('user')->where('role', 'hubin')->first()->id,
            'no_telp'       => '08631499875',
            'jenis_kelamin' => fake()->randomElement(['L', 'P'])
        ]);

        /* ------------------------------- SEED WALAS ------------------------------- */
        \App\Models\Walas::factory()->create([
            'nip'           => rand(10000000, 9999999999),
            'nama'          => fake('id_ID')->name(),
            'id_user'       => DB::table('user')->where('role', 'walas')->first()->id,
            'no_telp'       => '08631499875',
            'jenis_kelamin' => fake()->randomElement(['L', 'P'])
        ]);

        /* ------------------------------- SEED KELAS ------------------------------- */
        \App\Models\Kelas::factory()->create([
            'id_jurusan' => DB::table('jurusan')->first()->id,
            'kelompok'   => 'A',
            'tingkat'    => '10',
            'angkatan'   => 2022,
            'wali_kelas' => DB::table('walas')->first()->nip
        ]);

        /* ------------------------------- SEED TATA USAHA ------------------------------- */
        \App\Models\TataUsaha::factory()->create([
            'nip'           => rand(10000000, 9999999999),
            'nama'          => fake('id_ID')->name(),
            'id_user'       => DB::table('user')->where('role', 'tu')->first()->id,
            'no_telp'       => '08631499875',
            'jenis_kelamin' => fake()->randomElement(['L', 'P'])
        ]);

        /* ------------------------------- SEED SISWA ------------------------------- */
        \App\Models\Siswa::factory()->create([
            'nis'           => rand(10000000, 9999999999),
            'id_kelas'      => DB::table('kelas')->first()->id,
            'id_user'       => DB::table('user')->where('role', 'walas')->first()->id,
            'nama'          => fake('id_ID')->name(),
            'email'         => fake('id_ID')->safeEmail(),
            'tahun_masuk'   => 2021,
            'jenis_kelamin' => fake()->randomElement(['L', 'P']),
            'tempat_lahir'  => fake('id_ID')->city(),
            'tanggal_lahir' => fake('id_ID')->date(),
            'alamat'        => fake('id_ID')->address(),
            'no_telp'       => '08631499875',
            'no_telp_wali'  => '08631499871',
        ]);

        /* ----------------------------- SEED PEMBIMBING ---------------------------- */
        //Pembimbing sekolah
        \App\Models\Pembimbing::factory()->create([
            'nip_nik'       => rand(10000000, 9999999999),
            'id_jurusan'    => DB::table('jurusan')->first()->id,
            'id_user'       => DB::table('user')->where('role', 'pembimbing')->get()[0]->id,
            'nama'          => fake('id_ID')->name(),
            'no_telp'       => '08631499875',
            'email'         => fake('id_ID')->safeEmail(),
            'lingkup'       => 'Sekolah',
            'jenis_kelamin' => fake()->randomElement(['L', 'P'])
        ]);
        //Pembimbing industri
        \App\Models\Pembimbing::factory()->create([
            'nip_nik'       => rand(10000000, 9999999999),
            'id_jurusan'    => DB::table('jurusan')->first()->id,
            'id_user'       => DB::table('user')->where('role', 'pembimbing')->get()[1]->id,
            'nama'          => fake('id_ID')->name(),
            'no_telp'       => '08631499875',
            'email'         => fake('id_ID')->safeEmail(),
            'lingkup'       => 'Industri',
            'jenis_kelamin' => fake()->randomElement(['L', 'P'])
        ]);

        /* ------------------------------- SEED KAPROG ------------------------------ */
        \App\Models\Kaprog::factory()->create([
            'nip'           => rand(10000000, 9999999999),
            'id_jurusan'    => DB::table('jurusan')->first()->id,
            'id_user'       => DB::table('user')->where('role', 'kaprog')->first()->id,
            'nama'          => fake('id_ID')->name(),
            'no_telp'       => '08631499875',
            'jenis_kelamin' => fake()->randomElement(['L', 'P'])
        ]);
    }
}

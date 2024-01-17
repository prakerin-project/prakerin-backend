<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;
use Hash;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'id' => Str::uuid(),
            'password' => Hash::make('123'),
            'role' => 'hubin',
            'username' => 'admin'
        ]);
        \App\Models\Hubin::factory()->create([
            'nip' => rand(10000000, 9999999999),
            'nama'=>fake('id_ID')->name(),
            'id_user' => DB::table('user')->where('username', 'admin')->first()->id,
            'no_telp' => 0,
            'jenis_kelamin' => 'L'
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

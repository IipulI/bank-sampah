<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@mail.co',
            'password' => Hash::make('12345678'),
            'role' => 'admin'
        ]);

        DB::table('staff')->insert([
            'user_id' => 1,
            'nama' => 'admin',
            'role' => 'admin'
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'staff',
            'email' => 'staff@mail.co',
            'password' => Hash::make('12345678'),
            'role' => 'admin'
        ]);

        DB::table('staff')->insert([
            'user_id' => 2,
            'nama' => 'staff',
            'role' => 'staff'
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'name' => 'member',
            'email' => 'member@mail.co',
            'password' => Hash::make('12345678'),
            'role' => 'member'
        ]);

        DB::table('anggota')->insert([
            'user_id' => 3,
            'nama' => 'member',
            'no_nik' => mt_rand(1000000000000000, 9999999999999999),
            'alamat' => Str::random(50),
            'nomor_telepon'=> mt_rand(1000000000, 9999999999),
        ]);
    }
}

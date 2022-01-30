<?php

namespace Database\Seeders;

use App\Models\kategori;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class oneseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //ADMIN SEEDER
        DB::table('users')->insert([
            'name' => 'Paimin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'tipeuser' => 'admin',
            'nomerinduk' => '1',
            'username' => 'admin',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

         DB::table('users')->insert([
            'name' => 'Pegawai',
            'email' => 'pegawai@gmail.com',
            'password' => Hash::make('pegawai'),
            'tipeuser' => 'pegawai',
            'nomerinduk' => '2',
            'username' => 'pegawai',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

        DB::table('users')->insert([
            'name' => 'Manajer',
            'email' => 'manajer@gmail.com',
            'password' => Hash::make('manajer'),
            'tipeuser' => 'manajer',
            'nomerinduk' => '3',
            'username' => 'manajer',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);


        DB::table('users')->insert([
            'name' => 'Petani',
            'email' => 'petani@gmail.com',
            'password' => Hash::make('petani'),
            'tipeuser' => 'petani',
            'nomerinduk' => '3',
            'username' => 'petani',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

          //settings SEEDER
        DB::table('settings')->insert([
            'app_nama' => 'SI Pelaporan Pengolahan Produksi',
            'app_namapendek' => 'SMM',
            'paginationjml' => '10',
            'lembaga_nama' => 'PT Pelaporan Pengolahan Produksi',
            'lembaga_jalan' => 'Jl. Warnawarni No. 11, Kec. Kromengan, Kab. Malang',
            'lembaga_telp' => '0341-123121',
            'lembaga_kota' => 'Malang',
            'lembaga_logo' => 'assets/upload/logo.png',
            'sekolahttd' => 'Nama Kepala Sekolah M.Pd',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);


         DB::table('kategori')->insert([
            'nama' => 'Kelompok Tani Desa Anggora',
            'prefix' => 'kelompoktani',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);


         DB::table('kategori')->insert([
            'nama' => 'Kelompok Tani Desa Persia',
            'prefix' => 'kelompoktani',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

         DB::table('bahan')->insert([
            'nama' => 'Kedelai',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

         DB::table('bahan')->insert([
            'nama' => 'Karet',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);
         DB::table('bahan')->insert([
            'nama' => 'Kapas',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);


         DB::table('produk')->insert([
            'nama' => 'Tempe',
            'hargajual' => 10000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);



         DB::table('produk')->insert([
            'nama' => 'Bantal',
            'hargajual' => 20000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);


         DB::table('produk')->insert([
            'nama' => 'Sandal',
            'hargajual' => 15000,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
         ]);

    }
}

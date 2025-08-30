<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
             DB::table('pegawais')->insert([
            'nama' => 'Reyhan',
            'alamat' => 'BJN',
            'kelamin' => 'L',
            'telp' => '081',            
        ]);
    }
}

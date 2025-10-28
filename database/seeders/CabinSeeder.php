<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CabinSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cabins')->insert([
            [
                'nama_cabin' => 'Bobocabin Puncak',
                'lokasi' => 'Puncak, Bogor',
                'harga_per_malam' => 650000,
                'gambar' => 'https://pix10.agoda.net/hotelImages/31675127/-1/daf6f8a6b3266094800a56bfc30452ca.jpg?ce=0&s=1024x768',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_cabin' => 'Bobocabin Dieng',
                'lokasi' => 'Dieng, Wonosobo',
                'harga_per_malam' => 500000,
                'gambar' => 'https://cf.bstatic.com/xdata/images/hotel/max1024x768/516264685.jpg?k=0202f4711d3a69ce1961de6f1eb9c37c363bcad0243a2f7cd038207946047adf&o=&hp=1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_cabin' => 'Bobocabin Rinjani',
                'lokasi' => 'Rinjani, Lombok',
                'harga_per_malam' => 1200000,
                'gambar' => 'https://cf.bstatic.com/xdata/images/hotel/max1024x768/579875520.jpg?k=7358ddf5902ad0167c83b9cefd72f9dd77afb137414ef91be99fc0b77e1d0a39&o=&hp=1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

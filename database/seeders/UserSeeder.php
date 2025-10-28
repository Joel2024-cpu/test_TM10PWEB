<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->updateOrInsert(
            ['username' => 'admin'],
            [
                'password' => Hash::make('admin123'), // ✅ HASH PASSWORD
                'role' => 'admin'
            ]
        );

        DB::table('users')->updateOrInsert(
            ['username' => 'nazwa'],
            [
                'password' => Hash::make('nazwa123'), // ✅ HASH PASSWORD
                'role' => 'user'
            ]
        );
    }
}

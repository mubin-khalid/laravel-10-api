<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                'name' => Str::random(10),
                'email' => 'admin@admin.com',
                'email_verified_at' => date("Y-m-d H:i:s"),
                'password' => Hash::make('password'),
            ]
        );
    }
}

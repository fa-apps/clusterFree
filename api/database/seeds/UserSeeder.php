<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Mr le responsable sanitaire local',
            'role' => 'RSL',
            'email' => 'free.ads.07.2020@gmail.com',
            'password' => Hash::make('password'),
            'created_at' => '2020-01-01'
        ]);
    }
}

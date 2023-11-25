<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Use the DB facade to insert a new user
        DB::table('users')->insert([
            'name' => 'Novi Putri Agistiani', 
            'username' => 'noviptr', 
            'password' => Hash::make('345'), 
            'role' => 'admin', 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

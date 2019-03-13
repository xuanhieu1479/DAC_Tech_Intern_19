<?php

use Illuminate\Database\Seeder;
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
        DB::table('users')->insert([
            'user_name' => 'Hieu',
            'password' => Hash::make('qweasd'),
            'isAdmin' => 1,
        ]);

        DB::table('users')->insert([
            'user_name' => 'Khanh',
            'password' => Hash::make('qweasd'),
            'isAdmin' => 0,
        ]);

        DB::table('users')->insert([
            'user_name' => 'Tri',
            'password' => Hash::make('qweasd'),
            'isAdmin' => 0,
        ]);
    }
}

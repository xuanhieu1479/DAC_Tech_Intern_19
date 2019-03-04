<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'role_id' => 0,
            'role_name' => 'admin',
        ]);

        DB::table('roles')->insert([
            'role_id' => 1,
            'role_name' => 'leader',
        ]);

        DB::table('roles')->insert([
            'role_id' => 2,
            'role_name' => 'member',
        ]);
    }
}

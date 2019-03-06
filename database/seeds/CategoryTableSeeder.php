<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert([
            'category_id' => 'dc',
            'category_name' => 'dirt cheap',
        ]);
        
        DB::table('category')->insert([
            'category_id' => 'mz',
            'category_name' => 'medium zen',
        ]);

        DB::table('category')->insert([
            'category_id' => 'hq',
            'category_name' => 'high quality',
        ]);
    }
}

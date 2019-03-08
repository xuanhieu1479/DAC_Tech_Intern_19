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

        DB::table('category')->insert([
            'category_id' => 'fr',
            'category_name' => 'first rate',
        ]);

        DB::table('category')->insert([
            'category_id' => 'ss',
            'category_name' => 'so so',
        ]);

        DB::table('category')->insert([
            'category_id' => 'f',
            'category_name' => 'fake',
        ]);

        DB::table('category')->insert([
            'category_id' => 'sc',
            'category_name' => 'second hand',
        ]);
        
    }
}

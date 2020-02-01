<?php

use Illuminate\Database\Seeder;
use App\Category;
use Faker\Factory as Faker;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();

        DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => '弁当・惣菜',
                'delete_flg' => false
            ],
            [
                'id' => 2,
                'name' => 'パン',
                'delete_flg' => false
            ],
            [
                'id' => 3,
                'name' => '飲料',
                'delete_flg' => false
            ],
            [
                'id' => 4,
                'name' => '雑貨',
                'delete_flg' => false
            ],
        ]);
    }
}

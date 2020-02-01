<?php

use Illuminate\Database\Seeder;
use App\Store;
use Faker\Factory as Faker;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Store::truncate();

        factory(Store::class, 50) -> create();
    }
}

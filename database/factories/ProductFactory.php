<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker -> text($maxNbChars = 190),
        'pic' => 'https://laravalsample.s3-ap-northeast-1.amazonaws.com/10086.png',
        'comment' => $faker -> text,
        'price' => $faker -> numberBetween($min = 200, $max = 2000),
        'limit' => $faker -> dateTimeBetween($startDate = '-1 weeks',$endDate = '+1 months'),
        'category_id' => $faker -> numberBetween($min = 1, $max = 3),
        'store_id' => $faker -> randomElement(['2','12','22','32']),
        'delete_flg' => false
    ];
});

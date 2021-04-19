<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    $name = $faker->name;
    return [
        'title' => $name,
        'str_id' => 'NB' . $faker->numberBetween($min = 0, $max = 100),
        'price' => 10000,
        'dis_price' => 0,
        'product_category_id' => $faker->numberBetween($min = 86, $max = 97),
        'brand_id' => $faker->numberBetween($min = 0, $max = 5),
        'avatar_image' => '/uploads/noimage.jpg',
        'images' => '',
        'short_desc' => $faker->paragraph(2),
        'content' => $faker->paragraph(4),
        'publish' => 1,
        'highlight' => $faker->numberBetween($min = 0, $max = 1),
        'lastest' => $faker->numberBetween($min = 0, $max = 1),
        'meta_title' => $name,
        'meta_keyword' => $name,
        'meta_desc' => $name,
        'slug' => Str::slug($name, '-')
    ];
});

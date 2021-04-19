<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductCategory;
use Faker\Generator as Faker;

$factory->define(ProductCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'parent_id' => 0,
        'avatar_image' => '',
        'short_desc' => $faker->paragraph(2),
        'ad_content' => $faker->paragraph(4),
        'publish' => $faker->numberBetween($min = 0, $max = 1),
        'highlight' => $faker->numberBetween($min = 0, $max = 1),
        'meta_title' => $faker->name,
        'meta_keyswords' => $faker->name,
        'meta_desc' => $faker->name,
        'slug' => '',
    ];
});

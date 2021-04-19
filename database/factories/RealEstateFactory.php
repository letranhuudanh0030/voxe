<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RealEstate;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(RealEstate::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'slug' => Str::slug($faker->name, '-'),
        'product_category_id' => 83,
        'city_code' => 4,
        'district_code' => 43,
        'ward_code' => 1321,
        'region_code' => $faker->numberBetween($min = 1, $max = 3),
        'price' => $faker->numberBetween($min = 1000000, $max = 100000000),
        'currency' => $faker->numberBetween($min = 1, $max = 2),
        'acreage' => $faker->numberBetween($min = 10, $max = 500),
        'unit_area' => $faker->numberBetween($min = 1, $max = 2),
        'description' => $faker->paragraph(4),
        'condition' => $faker->paragraph(4),
        'avatar_image' => 'http://localhost:8000/uploads/san-pham/san-pham-moi/ao-mua-bit-bong/(1-1)-(3-2)-10.jpg',
        'images' => '/uploads/san-pham/san-pham-moi/ao-mua-bit-bong/(1-1)-(3-2)-00.jpg,/uploads/san-pham/san-pham-moi/ao-mua-bit-bong/(1-1)-(3-2)-.jpg',
        'contact' => $faker->paragraph(4),
        'publish' => $faker->numberBetween($min = 0, $max = 1),
        'highlight' => $faker->numberBetween($min = 0, $max = 1),
        'lastest' => $faker->numberBetween($min = 0, $max = 1),
        'sort_order' => 0,
        'meta_title' => $faker->name,
        'meta_keywords' => $faker->name,
        'meta_desc' => $faker->name,
        // 'functional_subdivision' => '',
        // 'infrastructure' => '',
        // 'investment_costs' => '',
        // 'career' => '',
        // 'incentives' => '',
        'suport' => $faker->paragraph(4),

        'functional_subdivision' => $faker->paragraph(4),
        'infrastructure' => $faker->paragraph(4),
        'investment_costs' => $faker->paragraph(4),
        'career' => $faker->paragraph(4),
        'incentives' => $faker->paragraph(4),

        'type_spec' => 'f-nha-xuong',
    ];
});

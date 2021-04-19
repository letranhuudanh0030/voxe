<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    $name = $faker->name;
    return [
        'title' => $name,
        'article_category_id' => $faker->numberBetween($min = 1, $max = 5),
        'avatar_image' => '',
        'short_desc' => $faker->paragraph(2),
        'content' => $faker->paragraph(4),
        'publish' => $faker->numberBetween($min = 0, $max = 1),
        'highlight' => $faker->numberBetween($min = 0, $max = 1),
        'lastest' => $faker->numberBetween($min = 0, $max = 1),
        'meta_title' => $name,
        'slug' => $name,
        'meta_keywords' => $name,
        'meta_desc' => $name,
        'sort_order' => 0
    ];
});

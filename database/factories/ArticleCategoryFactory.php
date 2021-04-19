<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ArticleCategory;
use App\Model;
use Faker\Generator as Faker;

$factory->define(ArticleCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'parent_id' => 0,
        'page_type' => 0,
        'cate_image' => '',
        'avatar_image' => '',
        'short_desc' => $faker->paragraph(2),
        'meta_title' => $faker->text(10),
        'meta_keywords' => $faker->text(10),
        'meta_desc' => $faker->text(10),
        'slug' => '',
        'publish' => 1,
        'highlight' => 1,
        'one_article' => 1,
        'link' => 1,
        'un_link' => 1,
        'sort_order' => 0
    ];
});

<?php

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    $title = $faker->sentence(rand(3, 8), true);
    $text = $faker->realText(rand(1000, 4000));
    $is_published = rand(1, 5) > 1;

    $data = [
        'category_id' => rand(1, 11);
        'user_id' => (rand(1, 5) == 5 ) ? 1 : 2,
        'title' => $title,
        'slug' => Str::slug($title),
        'excerpt' => $faker->text(rand(40, 100)),
        'content_raw' => $txt,
        'content_html' => $txt,
        'is_published' => $is_published,
        'published_at' => $is_published ? $faker->dateTimeBetween('-2 months', '-1 days') : null,
        'created_at' => $faker->dateTimeBetween('-2 months', '-1 days'),
        'updated_at'
    ];
    return [
    ];
});

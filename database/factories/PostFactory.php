<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title'         =>          $faker->sentence(rand(5,10)),
	    'content'       =>          $faker->paragraph(rand(3, 7), true),
    ];
});

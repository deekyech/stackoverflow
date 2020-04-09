<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Answer;
use Faker\Generator as Faker;

$factory->define(Answer::class, function (Faker $faker) {
    return [
        'body'          =>      $faker->paragraph(rand(3, 6), true),
	    'user_id'       =>      \App\User::pluck('id')->random()
    ];
});

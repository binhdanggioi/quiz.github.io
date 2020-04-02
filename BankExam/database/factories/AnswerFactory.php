<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Answer;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Answer::class, function (Faker $faker) {
    return [
        'content' => $faker->text(),
        'correct' => $faker->boolean,
    ];
});

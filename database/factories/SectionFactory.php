<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Section;
use Faker\Generator as Faker;
use App\Routine;

$factory->define(Section::class, function (Faker $faker) {
    return [
        'routine_id' => function(){
            return Routine::all()->random();
        },
        'name' => $faker->word,
        'description' => $faker->sentence(),
    ];
});

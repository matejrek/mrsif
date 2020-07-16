<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TrackerResult;
use Faker\Generator as Faker;
use App\Tracker;

$factory->define(TrackerResult::class, function (Faker $faker) {
    return [
        'value' => $faker->numberBetween(71,74),
        'tracker_id' => function(){
            return Tracker::all()->random();
        }
    ];
});

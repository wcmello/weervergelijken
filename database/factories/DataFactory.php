<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Data;
use App\Location;
use Faker\Generator as Faker;

$factory->define(Data::class, function (Faker $faker) {
    return [
        'location_id' => $faker->numberBetween($min = 0, $max =  Location::count()),
        'dateTime' => $faker->dateTimeInInterval($startDate = 'now', $interval = '+ 4 hours', $timezone = 'Europe/Paris'),
        'temp' => $faker->numberBetween($min = -4, $max = 20), // password
        'rainChance' => $faker->numberBetween($min = 0, $max = 100),
    ];
});

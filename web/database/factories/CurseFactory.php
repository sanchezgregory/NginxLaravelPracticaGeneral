<?php

use App\Curse;
use Faker\Generator as Faker;

$factory->define(Curse::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->domainName,
        'premium' => $faker->boolean,
        'lessons' => $faker->randomElement($array = array('6','8', '12')),
    ];
});

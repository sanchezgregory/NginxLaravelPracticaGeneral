<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(\App\Content::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(10, true),
        'body' => $faker->text(100, true),
        'url' => $faker->url,
        'curse_id' => $faker->randomElement(iterator_to_array(DB::table('curses')->pluck('id'))),
    ];
});



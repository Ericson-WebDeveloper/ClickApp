<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Click::class, function (Faker $faker) {
    return [
        'date' => Carbon::today(),
        'clicks' => 5,
    ];
});

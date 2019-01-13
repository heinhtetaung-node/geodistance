<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\Orders::class, function (Faker $faker) {
    $statusarr = ['UNASSIGNED', 'TAKEN'];
    return [
        'start_coordinates' => rand(10,99),
        'end_coordinates' => rand(10,99),
        'distance' => rand(10,100000),
        'status' => $statusarr[array_rand($statusarr, 1)]
    ];
});

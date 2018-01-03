<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('rahasia'),
        'status'         => $faker->randomElement($array = array('Aktif', 'Tidak Aktif')),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Website::class, function (Faker\Generator $faker) {
    return [
        'domain' => $faker->unique()->domainName,
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        'name'  => $faker->unique()->word,
        'title' => $faker->sentence(4),
    ];
});

$factory->define(App\Catalogue::class, function (Faker\Generator $faker) {
    return [
        'url'        => $faker->url,
        'user_id'    => $faker->randomDigitNotNull,
        'product_id' => $faker->randomDigitNotNull,
        'website_id' => $faker->randomDigitNotNull,
    ];
});

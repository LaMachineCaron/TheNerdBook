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

/**
 * User factory.
 *
 * @var \Illuminate\Database\Eloquent\Factory $factory
 */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/**
 * Post factory
 *
 * @var \Illuminate\Database\Eloquent\Factory $factory
 */
$factory->define(App\Models\Post::class, function (Faker\Generator $faker) {
    return [
        'user_id' => App\User::inRandomOrder()->first()->id,
        'url' => $faker->url,
        'title' => $faker->title,
        'caption' => $faker->realText(50, 2),
        'channel_name' => $faker->name,
        'type' => 3
    ];
});

/**
 * Comment factory
 *
 * @var \Illuminate\Database\Eloquent\Factory $factory
 */
$factory->define(App\Models\Comment::class, function (Faker\Generator $faker) {
    return [
        'user_id' => App\User::inRandomOrder()->first()->id,
        'post_id' => App\Models\Post::inRandomOrder()->first()->id,
        'content' => $faker->realText(100, 2),
    ];
});

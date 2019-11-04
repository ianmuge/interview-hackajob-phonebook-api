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

$fakerGB = Faker\Factory::create('en_GB');

$factory->define(App\User::class, function (Faker\Generator $faker) use ($fakerGB) {
    return [
        'name' => $fakerGB->name,
        'email' => $fakerGB->email,
    ];
});
$factory->define(App\Contact::class, function (Faker\Generator $faker)use ($fakerGB) {
    return [
        'name' => $fakerGB->name,
        'phonenumber' => $fakerGB->phoneNumber,
        'address' => $fakerGB->address,
    ];
});

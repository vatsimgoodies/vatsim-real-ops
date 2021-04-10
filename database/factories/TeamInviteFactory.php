<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\TeamInvite;
use Faker\Generator as Faker;

$factory->define(TeamInvite::class, function (Faker $faker) {
    return [
        'team_id' => tenant('id'),
        'email' => $faker->safeEmail,
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Channel;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Channel::class, function (Faker $faker) {
    return [
        'name'=>$faker->sentence(2),
        'user_id'=>function(){
        return factory(User::class)->create()->id;
        },
        'description'=>$faker->sentence(30)

    ];
});

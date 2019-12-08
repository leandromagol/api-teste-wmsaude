<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Paciente;
use Faker\Generator as Faker;

$factory->define(Paciente::class, function (Faker $faker) {
    return [
        //
        'nome'=>$faker->name,
        'sexo'=>$faker->randomElement(['masculino' ,'feminino']),
        'idade'=>$faker->numberBetween(1,110),
        'email'=>$faker->email,
    ];
});

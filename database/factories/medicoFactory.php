<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Medico;

use Faker\Generator as Faker;

$factory->define(App\Medico::class, function (Faker $faker) {
    return [
         'nome' => $faker->name,
        'crm'=>$faker->numberBetween(10000,210000000),
        'email' => $faker->unique()->safeEmail,
         'especialidade'=>$faker->randomElements(['Cardiologista' ,'Dentista','Terapeuta','ginecologista','urologista','Clinico geral'])  
    ];
});

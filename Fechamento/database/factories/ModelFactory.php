<?php


// SEED DE USUÁRIO
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];


});

// SEED DE GERENCIAS
$factory->define(App\Gerencia::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->name,
        'sigla' => str_random(3)
    ];
});

// SEED DE EMPRESAS
$factory->define(App\Empresas::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->name
    ];
});



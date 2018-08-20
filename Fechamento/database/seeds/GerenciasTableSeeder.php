<?php

use Illuminate\Database\Seeder;

class GerenciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Gerencia::class, 5)->create(); 

    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        $faker = \Faker\Factory::create();
        $this->insertarPerros($faker, 20);
        // \App\Models\User::factory(10)->create();
    }

    public function insertarPerros( $faker, $numero)
    {
        if ($numero < 1) return false;
        ini_set("allow_url_fopen", 1);
        
        foreach (range(1,$numero) as $index) {
            $json = file_get_contents('https://dog.ceo/api/breeds/image/random');
            $obj = json_decode($json);
            DB::table('perros')->insert([
                'perro_nombre' => $faker -> firstName(),
                'perro_foto' =>  $obj->message,
                'perro_descripcion' => $faker ->sentence(),
                'created_at' => now()
            ]);
        }

        return true;
        
    }

    // public function insertarPreferencias($faker, $numero)
    // {
    //     if ($numero < 1) return false;
    //     foreach (range(1,$numero) as $index) {
    //         DB::table('interaccions')->insert([
    //             'perro_nombre' => $faker -> firstName(),
    //             'perro_descripcion' => $faker ->sentence(),
    //             'created_at' => now()
    //         ]);
    //     }

    //     return true;
    // }
}

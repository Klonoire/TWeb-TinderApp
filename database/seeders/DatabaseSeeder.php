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
        $this->insertarPerros($faker, 100);
        $this->insertarInteracciones($faker, 100);
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

    public function insertarInteracciones($faker, $numero)
    {
        $perro_id = DB::table('perros')->pluck('id')->toArray();
        $interesados = array();
        $candidatos = array();
        
        foreach (range(1,$numero) as $index) {
            if(random_int(0,1) ==1){
                $preferencia= 'A';
            }else{
                $preferencia= 'R';
            }
            $loop=true;
            while($loop){
                $interesado = array_rand($perro_id, 1);
                $candidato = array_rand($perro_id, 1);

                if($interesado !== $candidato){
                    if(count($interesados) == 0){
                        $loop = false;
                    }else{
                        for ($i=0;$i<count($interesados); $i++) {
                            if ($interesados[$i] == $candidatos[$i]){
                                $loop= true;
                                break;
                            }else{
                                $loop=false;
                            }
                        }
                    }
                }
                if($loop==false){
                    array_push($interesados, $interesado);
                    array_push($candidatos, $candidato);
                }
            }

            DB::table('interaccions')->insert([
                'perro_interesado_id' => $interesado,
                'perro_candidato_id' => $candidato,
                'preferencia' => $preferencia,
                'created_at' => now()
            ]);
        }

        return true;
    }
}

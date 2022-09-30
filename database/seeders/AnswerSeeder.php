<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $comentarios = array(0 => 'Estan chidos tus momos, eres un crack',
         1 => 'Igual yo hermano, los mejores momos',
         2 => 'Tus historias son geniales, vale la pena cada centavo',
         3 => 'Muy linda historia y maravilloso final, me encanto a mi tambien');

        $idUsuarios = array(0 => '7', 1 => '4', 2 => '4', 3 => '7');

        $idComent = array(0 => '1', 1 => '2', 2 => '3', 3 => '4');

        for ($i=0; $i <4 ; $i++) { 
            DB::table('answers')->insert([
                'comentario' => $comentarios[$i],
                'use_id' => $idUsuarios[$i],
                'use_com_id' => $idComent[$i]
            ]);
        }
        
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $preguntas = array(0 => '¿Cuanto tiempo demora el servicio?',
         1 => '¿Existe la posibilidad de obtener alguna rebaja?',
         2 => '¿Que pasa si no arreglan mi problema?',
         3 => '¿Atienden todos los días?',
         4 => '¿Hacen turnos nocturnos?',
         5 => '¿Cuanto tiempo demora el servicio?',
         6 => '¿Existe la posibilidad de obtener alguna rebaja?',
         7 => '¿Que pasa si no arreglan mi problema?',
         8 => '¿Atienden todos los días?',
         9 => '¿Hacen turnos nocturnos?');

         $respuestas = array(0 => 'Demora entre dos o tres días',
         1 => 'Todo se puede conversar, asi que no se descarta',
         2 => 'No se le cobraría al cliente',
         3 => 'Atendemos de Lunes a Domingo excepto los feriados',
         4 => 'No, por un tema de seguridad trabajamos de 8:00 am hasta las 6:00 pm',
         5 => 'Demora entre dos o tres días',
         6 => 'Todo se puede conversar, asi que no se descarta',
         7 => 'No se le cobraría al cliente',
         8 => 'Atendemos de Lunes a Domingo excepto los feriados',
         9 => 'No, por un tema de seguridad trabajamos de 8:00 am hasta las 6:00 pm');

        $idSO = array(0 => '2', 1 => '2', 2 => '2', 3 => '2', 4 => '2', 5 => null, 6 => null, 7 => null, 8 => null, 9 => null);

        $idST = array(0 => null, 1 => null, 2 => null, 3 => null, 4 => null, 5 => '1', 6 => '1', 7 => '1', 8 => '1', 9 => '1');

        for ($i=0; $i <10 ; $i++) { 
            DB::table('questions')->insert([
                'pregunta' => $preguntas[$i],
                'respuesta' => $respuestas[$i],
                'use_occ_id' => $idSO[$i],
                'use_tal_id' => $idST[$i]
            ]);
        }

    }
}

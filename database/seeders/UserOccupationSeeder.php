<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserOccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('use_occs')->insert([
            'use_id' => '1',
            'ser_occ_id' => '2',
            'ser_occ_name' => 'Reparador de computadoras',
            'descripcion' => 'Reparo todo tipo de computadoras, laptos, lo que deseas te lo reparo',
            'precio' => 20.00,
            'imagen'=> 'https://www.compudepot.net/data/files/instalacion-mantenimiento-y-reparacion-de-pc-y-redes_30871784_xxl.jpg'


        ]);
        DB::table('use_occs')->insert([
            'use_id' => '2',
            'ser_occ_id' => '1',
            'ser_occ_name' => 'Gasfitero de madrigeras',
            'descripcion' => 'Hago cualquier tipo de diseño grafico 2D o 3D, tambien hagos buenos momos, echate un OjitO por aqui',
            'precio' => 600.00,
            'imagen'=>'https://cdn.euroinnova.edu.es/img/subidasEditor/dise%C3%B1o%20grafico-1598602026.jpg',
            'use_occ_group_payment'=>true,
            'precio_actual'=>10
        ]);

    }
}

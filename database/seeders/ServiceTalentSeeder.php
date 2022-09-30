<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ServiceTalentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_talent')->insert([
            'ser_tal_name' => 'Abridor de cajas',
        ]);
        DB::table('service_talent')->insert([
            'ser_tal_name' => 'Narrador de Audiolibros',
        ]);
        DB::table('service_talent')->insert([
            'ser_tal_name' => 'Contador de chistes',
        ]);
        DB::table('service_talent')->insert([
            'ser_tal_name' => 'Probador de ropa',
        ]);
        DB::table('service_talent')->insert([
            'ser_tal_name' => 'Creador de videos rapidos',
        ]);
    }
}

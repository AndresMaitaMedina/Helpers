<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ServiceOccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_occupations')->insert([
            'ser_occ_name' => 'Gasfitero de madrigueras',
        ]);
        DB::table('service_occupations')->insert([
            'ser_occ_name' => 'Reparador de computadoras',
        ]);
        DB::table('service_occupations')->insert([
            'ser_occ_name' => 'Diseñador Gráfico',
        ]);
        DB::table('service_occupations')->insert([
            'ser_occ_name' => 'Estampador de polos',
        ]);
        DB::table('service_occupations')->insert([
            'ser_occ_name' => 'Confeccionador de ropas',
        ]);
    }
}

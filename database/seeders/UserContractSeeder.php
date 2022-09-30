<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contracts')->insert([
            'con_contract_date' => '2021-09-07 00:00:00',
            'con_hour' => '17:54:00.0000',
            'con_address' => 'Área 51',
            'con_description' => 'Asunto confidencial, remuneración jugosa',
            'con_price' => '40.00',
            'con_initial' => '2021-09-12 08:00:00',
            'use_offer'=>2,
            'use_receive'=>7,
            'use_occ_id'=>2,
            'con_status'=>1,
        ]);

        DB::table('contracts')->insert([
            'con_contract_date' => '2021-09-04 00:00:00',
            'con_hour' => '17:52:00.0000',
            'con_address' => 'Planeta tierra',
            'con_description' => 'Historias reveladoras, guardar el secreto',
            'con_price' => '47.00',
            'con_initial' => '2021-09-11 08:00:00',
            'use_offer'=>2,
            'use_receive'=>7,
            'use_tal_id'=>1,
            'con_status'=>1,
        ]);
    }
}

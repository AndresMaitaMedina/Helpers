<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('changes')->insert([
            'ser_occ_change'=>'2',
            'cha_name'=>'Reto de bailarin',
            'cha_count'=>0,
            'cha_25_percent_active'=>false,
            'cha_active'=>true
        ]);
    }
}

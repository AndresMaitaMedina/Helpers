<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserTalentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('use_tals')->insert([
            'use_id' => '2',
            'ser_tal_id' => '2',
            'ser_tal_name' => 'Narrador de audiolibros',
            'descripcion' => 'Soy un buen narrador, cuento buenos chistes',
            'precio' => 100.00,
            'imagen'=>'https://tec.com.pe/wp-content/uploads/2019/02/ElCuentacuentos.png'
        ]);
        DB::table('use_tals')->insert([
            'use_id' => '3',
            'ser_tal_id' => '1',
            'ser_tal_name' => 'Abridor de cajas',
            'descripcion' => 'Grabo videos abriendo cajas',
            'precio' => 10.00,
            'imagen'=>'https://media.istockphoto.com/photos/happy-girl-unpacking-clothes-after-online-shopping-picture-id1264257761?k=6&m=1264257761&s=612x612&w=0&h=dmb-RSs8JK4ur2Sf-2gF3zNUz0NXk2ykVaZU8b9efro='
        ]);
    }
}

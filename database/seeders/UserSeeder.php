<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        date_default_timezone_get();
        date_default_timezone_set('America/Lima');
        date('Y-m-d H:i:s');  
        $passwordNow = null;         
        $passwordNow = Hash::make('password');
        DB::table('users')->insert([
            'name' => "Pato",
            'lastname' => "Parodi",
            'DNI' => '65474357',
            'email' => 'pato@gmail.com',
            'birthdate' => Carbon::now(),
            'password' => $passwordNow,
            'password_confirmation'=>$passwordNow
        ]);
        $passwordNow = Hash::make('vacassss');
        DB::table('users')->insert([
            'name' => "Vizcarra Presidente",
            'lastname' => "2026",
            'DNI' => '23753421',
            'email' => 'vizcarra@gmail.com',
            'birthdate' => Carbon::now(),
            'password' => $passwordNow,
            'password_confirmation'=>$passwordNow
        ]);
        $passwordNow = Hash::make('valorant');
        DB::table('users')->insert([
            'name' => "Merino",
            'lastname' => "Lamas",
            'DNI' => '12345213',
            'email' => 'merino@gmail.com',
            'birthdate' => Carbon::now(),
            'password' => $passwordNow,
            'password_confirmation'=>$passwordNow
        ]);
        $passwordNow = Hash::make('cienciano');
        DB::table('users')->insert([
            'name' => "Presidenste",
            'lastname' => "UNMSM",
            'DNI' => '65374567',
            'email' => Str::random(10).'@gmail.com',
            'birthdate' => Carbon::now(),
            'password' => $passwordNow,
            'password_confirmation'=>$passwordNow
        ]);     

        $passwordNow = Hash::make('mandarin');
        DB::table('users')->insert([
            'name' => "caminante no hay camino",
            'lastname' => "se hace camino al andar",
            'DNI' => '23463456',
            'email' => 'mandarin@gmail.com',
            'birthdate' => Carbon::now(),
            'password' => 'presidente',
            'password_confirmation'=>$passwordNow
        ]);

        $passwordNow = Hash::make('mantecoso');
        DB::table('users')->insert([
            'name' => "caminante no hay camino",
            'lastname' => "se hace camino al andar",
            'DNI' => '12345678',
            'email' => 'mantecoso@gmail.com',
            'birthdate' => Carbon::now(),
            'password' => $passwordNow,
            'password_confirmation'=>$passwordNow
        ]);


        $passwordNow = Hash::make('perrovaca');
        DB::table('users')->insert([
            'name' => "Frank",
            'lastname' => "Alvarado Pardo",
            'DNI' => '82731232',
            'email' => 'alvarado4@unmsm.edu.pe',
            'birthdate' => '2021-07-11 23:47:47',
            'password' => $passwordNow,
            'password_confirmation'=>$passwordNow
        ]);        

    }
}

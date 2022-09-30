<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(ServiceOccupationSeeder::class);
        $this->call(ServiceTalentSeeder::class);
        $this->call(UserOccupationSeeder::class);
        $this->call(UserTalentSeeder::class);
        $this->call(QuestionSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(AnswerSeeder::class);
        $this->call(UserContractSeeder::class);
        $this->call(ChangeSeeder::class);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Token;
use App\Demand;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(Demand::class)->times(100)->create();
//        factory(Token::class)->times(100)->create();
        // $this->call(UsersTableSeeder::class);
    }
}

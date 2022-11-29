<?php

namespace Database\Seeders;

use App\Models\LotteryGame;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            LotteryGame::class,
        ]);
    }
}
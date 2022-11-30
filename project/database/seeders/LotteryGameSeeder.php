<?php

namespace Database\Seeders;

use App\Models\LotteryGame;
use Illuminate\Database\Seeder;

class LotteryGameSeeder extends Seeder
{

    /**
     * @return void
     */
    public function run(): void
    {
        LotteryGame::factory(20)->create();
    }
}

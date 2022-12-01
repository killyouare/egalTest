<?php

namespace Database\Factories;

use App\Models\LotteryGame;
use Illuminate\Database\Eloquent\Factories\Factory;

class LotteryGameFactory extends Factory
{

    protected $model = LotteryGame::class;

    public function definition(): array
    {
        return [
            "name" => $this->faker->unique()->text(20),
            "gamer_count" => $this->faker->numberBetween(2, 5),
            "reward_points" => $this->faker->numberBetween(),
        ];
    }
}

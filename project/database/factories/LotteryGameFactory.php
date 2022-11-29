<?php

use App\Models\LotteryGame;
use Illuminate\Database\Eloquent\Factories\Factory;

class LotteryGameFactory extends Factory
{

    protected $model = LotteryGame::class;

    public function definition(): array
    {
        return [
            "name" => $this->faker->word(),
            "gamer_count" => $this->faker->numberBetween(1),
            "reward_points" => $this->faker->numberBetween(),
        ];
    }
}
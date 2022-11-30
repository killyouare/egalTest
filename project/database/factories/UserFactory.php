<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class UserFactory extends Factory
{

    protected $model = User::class;

    public function definition(): array
    {
        return [
            "first_name" => $this->faker->firstName(),
            "last_name" => $this->faker->lastName(),
            "email" => $this->faker->unique()->email(),
            "is_admin" => $this->faker->boolean(),
            "password" => $this->faker->password(),
        ];
    }
}

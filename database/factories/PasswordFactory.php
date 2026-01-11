<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Password>
 */
class PasswordFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'username' => fake()->userName(),
            'password' => fake()->password(),
            'team_id' => Team::factory(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departments = [
            'Engineering', 'Marketing', 'Sales', 'Product',
            'Design', 'HR', 'Finance', 'Operations',
            'Customer Support', 'Legal', 'Data Science', 'DevOps',
            'Research', 'Content', 'QA', 'Security',
        ];

        return [
            'name' => fake()->randomElement($departments),
            'user_id' => User::factory(),
            'personal_team' => true,
        ];
    }
}

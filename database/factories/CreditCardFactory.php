<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class CreditCardFactory extends Factory
{
    public function definition(): array
    {
        $amexCardNumber = '378282246310005';

        $cardNumber = fake()->randomElement([
            '4242424242424242',
            '5555555555554444',
            $amexCardNumber,
            '4012888888881881',
            '5105105105105100',
        ]);

        $isAmex = $cardNumber === $amexCardNumber;

        $cvv = $isAmex
            ? (string) fake()->numberBetween(1000, 9999)
            : (string) fake()->numberBetween(100, 999);

        return [
            'name_on_card' => fake()->name(),
            'card_number' => $cardNumber,
            'expiry_month' => fake()->numberBetween(1, 12),
            'expiry_year' => fake()->numberBetween((int) date('Y'), (int) date('Y') + 5),
            'cvv' => $cvv,
            'name' => fake()->randomElement([
                'Personal Visa',
                'Business Mastercard',
                'Travel Card',
                'Online Shopping',
                'Emergency Card',
            ]),
            'notes' => fake()->randomElement([
                fake()->sentence(),
                fake()->paragraph(),
                null,
            ]),
            'team_id' => Team::factory(),
        ];
    }
}

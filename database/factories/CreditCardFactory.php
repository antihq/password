<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class CreditCardFactory extends Factory
{
    public function definition(): array
    {
        $cardTypes = [
            'visa' => '4242424242424242',
            'mastercard' => '5555555555554444',
            'amex' => '378282246310005',
            'visa2' => '4012888888881881',
            'mastercard2' => '5105105105105100',
        ];

        $cardNumber = fake()->randomElement($cardTypes);
        $expiryMonth = fake()->numberBetween(1, 12);
        $expiryYear = fake()->numberBetween((int) date('Y'), (int) date('Y') + 5);

        $isAmex = $cardNumber === '378282246310005';
        $cvv = $isAmex ? str_pad(fake()->numberBetween(1000, 9999), 4, '0') : str_pad(fake()->numberBetween(100, 999), 3, '0');

        $names = [
            'Personal Visa',
            'Business Mastercard',
            'Travel Card',
            'Online Shopping',
            'Emergency Card',
        ];

        return [
            'name_on_card' => fake()->name(),
            'card_number' => $cardNumber,
            'expiry_month' => $expiryMonth,
            'expiry_year' => $expiryYear,
            'cvv' => $cvv,
            'name' => fake()->randomElement($names),
            'notes' => fake()->randomElement([
                fake()->sentence(),
                fake()->paragraph(),
                null,
            ]),
            'team_id' => Team::factory(),
        ];
    }
}

<?php

use App\Models\CreditCard;

it('returns masked card number', function () {
    $creditCard = CreditCard::factory()->create(['card_number' => '4242424242424242']);

    expect($creditCard->maskedNumber)->toBe('•••• •••• •••• 4242');
});

it('returns formatted expiry date', function () {
    $creditCard = CreditCard::factory()->create([
        'expiry_month' => 12,
        'expiry_year' => 2027,
    ]);

    expect($creditCard->formattedExpiry)->toBe('12/2027');
});

it('returns formatted expiry date with single digit month', function () {
    $creditCard = CreditCard::factory()->create([
        'expiry_month' => 3,
        'expiry_year' => 2027,
    ]);

    expect($creditCard->formattedExpiry)->toBe('03/2027');
});

it('returns last four digits', function () {
    $creditCard = CreditCard::factory()->create(['card_number' => '5555555555554444']);

    expect($creditCard->lastFour)->toBe('4444');
});

it('encrypts card number on save', function () {
    $creditCard = CreditCard::factory()->create(['card_number' => '4242424242424242']);

    expect($creditCard->card_number)->toBe('4242424242424242');
});

it('encrypts cvv on save', function () {
    $creditCard = CreditCard::factory()->create(['cvv' => '123']);

    expect($creditCard->cvv)->toBe('123');
});

it('encrypts notes on save', function () {
    $creditCard = CreditCard::factory()->create(['notes' => 'Secret notes']);

    expect($creditCard->notes)->toBe('Secret notes');
});

it('belongs to a team', function () {
    $creditCard = CreditCard::factory()->create();

    expect($creditCard->team)->not->toBeNull();
});

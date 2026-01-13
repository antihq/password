<?php

use App\Models\CreditCard;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    $this->user = User::factory()->withPersonalTeam()->create();
});

it('mounts with pre-populated form values', function () {
    $creditCard = CreditCard::factory()->create(['team_id' => $this->user->currentTeam->id]);

    $component = Livewire::actingAs($this->user)
        ->test('credit-cards.item', ['creditCard' => $creditCard]);

    $component->assertSet('name_on_card', $creditCard->name_on_card)
        ->assertSet('card_number', $creditCard->card_number)
        ->assertSet('expiry_month', (string) $creditCard->expiry_month)
        ->assertSet('expiry_year', (string) $creditCard->expiry_year)
        ->assertSet('cvv', $creditCard->cvv)
        ->assertSet('name', $creditCard->name);
});

it('can cancel edit mode', function () {
    $creditCard = CreditCard::factory()->create(['team_id' => $this->user->currentTeam->id]);

    $component = Livewire::actingAs($this->user)
        ->test('credit-cards.item', ['creditCard' => $creditCard]);

    $component->set('name_on_card', 'Modified Name')
        ->set('card_number', '5555555555554444')
        ->set('expiry_month', 6)
        ->set('expiry_year', 2028)
        ->set('cvv', '456')
        ->set('name', 'Modified Card');

    $component->call('cancelEdit');

    $component->assertSet('name_on_card', $creditCard->name_on_card)
        ->assertSet('card_number', $creditCard->card_number)
        ->assertSet('expiry_month', (string) $creditCard->expiry_month)
        ->assertSet('expiry_year', (string) $creditCard->expiry_year)
        ->assertSet('cvv', $creditCard->cvv)
        ->assertSet('name', $creditCard->name);
});

it('can update credit card from modal', function () {
    $creditCard = CreditCard::factory()->create(['team_id' => $this->user->currentTeam->id]);

    Livewire::actingAs($this->user)
        ->test('credit-cards.item', ['creditCard' => $creditCard])
        ->set('name_on_card', 'Updated Name')
        ->set('card_number', '5555555555554444')
        ->set('expiry_month', 6)
        ->set('expiry_year', 2028)
        ->set('cvv', '456')
        ->set('name', 'Updated Card')
        ->call('save');

    $this->assertDatabaseHas('credit_cards', [
        'id' => $creditCard->id,
        'name_on_card' => 'Updated Name',
        'expiry_month' => 6,
        'expiry_year' => 2028,
        'name' => 'Updated Card',
    ]);

    $creditCard->refresh();
    expect($creditCard->card_number)->toBe('5555555555554444');
    expect($creditCard->cvv)->toBe('456');
});

it('validates required fields when updating credit card', function () {
    $creditCard = CreditCard::factory()->create(['team_id' => $this->user->currentTeam->id]);

    $component = Livewire::actingAs($this->user)
        ->test('credit-cards.item', ['creditCard' => $creditCard]);

    $component->set('name_on_card', '')
        ->set('card_number', '')
        ->set('expiry_month', '')
        ->set('expiry_year', '')
        ->set('cvv', '')
        ->call('save')
        ->assertHasErrors(['name_on_card', 'card_number', 'expiry_month', 'expiry_year', 'cvv']);
});

it('validates expiry month is between 1 and 12 when updating', function () {
    $creditCard = CreditCard::factory()->create(['team_id' => $this->user->currentTeam->id]);

    Livewire::actingAs($this->user)
        ->test('credit-cards.item', ['creditCard' => $creditCard])
        ->set('name_on_card', 'Test Name')
        ->set('card_number', '4242424242424242')
        ->set('expiry_month', 13)
        ->set('expiry_year', 2027)
        ->set('cvv', '123')
        ->call('save')
        ->assertHasErrors(['expiry_month']);
});

it('validates expiry year is not in the past when updating', function () {
    $creditCard = CreditCard::factory()->create(['team_id' => $this->user->currentTeam->id]);

    Livewire::actingAs($this->user)
        ->test('credit-cards.item', ['creditCard' => $creditCard])
        ->set('name_on_card', 'Test Name')
        ->set('card_number', '4242424242424242')
        ->set('expiry_month', 12)
        ->set('expiry_year', (int) date('Y') - 1)
        ->set('cvv', '123')
        ->call('save')
        ->assertHasErrors(['expiry_year']);
});

it('validates cvv max length when updating', function () {
    $creditCard = CreditCard::factory()->create(['team_id' => $this->user->currentTeam->id]);

    Livewire::actingAs($this->user)
        ->test('credit-cards.item', ['creditCard' => $creditCard])
        ->set('name_on_card', 'Test Name')
        ->set('card_number', '4242424242424242')
        ->set('expiry_month', 12)
        ->set('expiry_year', 2027)
        ->set('cvv', '12345')
        ->call('save')
        ->assertHasErrors(['cvv']);
});

it('can save credit card with all fields', function () {
    $creditCard = CreditCard::factory()->create([
        'team_id' => $this->user->currentTeam->id,
        'name' => 'Personal Visa',
    ]);

    Livewire::actingAs($this->user)
        ->test('credit-cards.item', ['creditCard' => $creditCard])
        ->set('name_on_card', 'Updated Name')
        ->set('card_number', '4242424242424242')
        ->set('expiry_month', 12)
        ->set('expiry_year', 2027)
        ->set('cvv', '123')
        ->set('name', 'Business Mastercard')
        ->call('save');

    $this->assertDatabaseHas('credit_cards', [
        'id' => $creditCard->id,
        'name_on_card' => 'Updated Name',
        'name' => 'Business Mastercard',
    ]);
});

it('can save credit card with notes', function () {
    $creditCard = CreditCard::factory()->create(['team_id' => $this->user->currentTeam->id, 'notes' => null]);

    Livewire::actingAs($this->user)
        ->test('credit-cards.item', ['creditCard' => $creditCard])
        ->set('name_on_card', 'Test Name')
        ->set('card_number', '4242424242424242')
        ->set('expiry_month', 12)
        ->set('expiry_year', 2027)
        ->set('cvv', '123')
        ->set('notes', 'Updated notes')
        ->call('save');

    $creditCard->refresh();
    expect($creditCard->notes)->toBe('Updated notes');
});

it('shows existing cardholder names for autocomplete', function () {
    CreditCard::factory()->create([
        'team_id' => $this->user->currentTeam->id,
        'name_on_card' => 'John Doe',
    ]);

    $component = Livewire::actingAs($this->user)
        ->test('credit-cards.item', ['creditCard' => CreditCard::factory()->create(['team_id' => $this->user->currentTeam->id])]);

    $existingNames = $component->get('existingCardholderNames');
    expect($existingNames)->toContain('John Doe');
});

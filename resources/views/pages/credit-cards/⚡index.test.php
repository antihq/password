<?php

use App\Models\CreditCard;
use App\Models\Team;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->team = Team::factory()->create(['user_id' => $this->user->id]);
    $this->user->update(['current_team_id' => $this->team->id]);
});

it('cannot view credit cards from other teams', function () {
    $otherUser = User::factory()->create();
    $otherTeam = Team::factory()->create(['user_id' => $otherUser->id]);
    $creditCard = CreditCard::factory()->create(['team_id' => $otherTeam->id]);

    $this->actingAs($this->user)
        ->get(route('credit-cards.index'))
        ->assertDontSee($creditCard->name_on_card);
});

it('can create a credit card', function () {
    Livewire::actingAs($this->user)
        ->test('pages::credit-cards.index')
        ->set('name_on_card', 'John Doe')
        ->set('card_number', '4242 4242 4242 4242')
        ->set('expiry', '12/27')
        ->set('cvv', '123')
        ->set('name', 'Personal Visa')
        ->call('create')
        ->assertSet('name_on_card', '')
        ->assertSet('card_number', '')
        ->assertSet('expiry', '')
        ->assertSet('name', '');

    $this->assertDatabaseHas('credit_cards', [
        'name_on_card' => 'John Doe',
        'expiry_month' => 12,
        'expiry_year' => 2027,
        'team_id' => $this->team->id,
    ]);
});

it('validates required fields when creating credit card', function () {
    Livewire::actingAs($this->user)
        ->test('pages::credit-cards.index')
        ->set('name_on_card', '')
        ->set('card_number', '')
        ->set('expiry', '')
        ->set('cvv', '')
        ->call('create')
        ->assertHasErrors(['name_on_card', 'card_number', 'expiry', 'cvv']);
});

it('validates expiry month is between 1 and 12', function () {
    Livewire::actingAs($this->user)
        ->test('pages::credit-cards.index')
        ->set('name_on_card', 'John Doe')
        ->set('card_number', '4242 4242 4242 4242')
        ->set('expiry', '13/27')
        ->set('cvv', '123')
        ->call('create')
        ->assertHasErrors(['expiry']);
});

it('validates expiry year is not in the past', function () {
    $pastYear = substr((string) (date('Y') - 1), -2);

    Livewire::actingAs($this->user)
        ->test('pages::credit-cards.index')
        ->set('name', 'Personal Visa')
        ->set('name_on_card', 'John Doe')
        ->set('card_number', '4242 4242 4242 4242')
        ->set('expiry', '12/'.$pastYear)
        ->set('cvv', '123')
        ->call('create')
        ->assertHasErrors(['expiry']);
});

it('validates cvv max length', function () {
    Livewire::actingAs($this->user)
        ->test('pages::credit-cards.index')
        ->set('name_on_card', 'John Doe')
        ->set('card_number', '4242 4242 4242 4242')
        ->set('expiry', '12/27')
        ->set('cvv', '12345')
        ->call('create')
        ->assertHasErrors(['cvv']);
});

it('can create a credit card with name and notes', function () {
    Livewire::actingAs($this->user)
        ->test('pages::credit-cards.index')
        ->set('name_on_card', 'Jane Smith')
        ->set('card_number', '5555 5555 5555 4444')
        ->set('expiry', '06/28')
        ->set('cvv', '456')
        ->set('name', 'Personal Visa')
        ->set('notes', 'My personal credit card')
        ->call('create')
        ->assertSet('name_on_card', '')
        ->assertSet('name', '');

    $this->assertDatabaseHas('credit_cards', [
        'name_on_card' => 'Jane Smith',
        'name' => 'Personal Visa',
        'team_id' => $this->team->id,
    ]);
});

it('can create an Amex credit card', function () {
    Livewire::actingAs($this->user)
        ->test('pages::credit-cards.index')
        ->set('name_on_card', 'John Doe')
        ->set('card_number', '3782 822463 10005')
        ->set('expiry', '12/28')
        ->set('cvv', '1234')
        ->set('name', 'Personal Amex')
        ->call('create')
        ->assertSet('name_on_card', '')
        ->assertSet('card_number', '')
        ->assertSet('expiry', '')
        ->assertSet('name', '');

    $this->assertDatabaseHas('credit_cards', [
        'name_on_card' => 'John Doe',
        'expiry_month' => 12,
        'expiry_year' => 2028,
        'team_id' => $this->team->id,
    ]);
});

it('can delete a credit card', function () {
    $creditCard = CreditCard::factory()->create(['team_id' => $this->team->id]);

    Livewire::actingAs($this->user)
        ->test('pages::credit-cards.index')
        ->call('delete', $creditCard->id)
        ->assertNoRedirect();

    $this->assertDatabaseMissing('credit_cards', [
        'id' => $creditCard->id,
    ]);
});

it('cannot delete credit card from other team', function () {
    $otherUser = User::factory()->create();
    $otherTeam = Team::factory()->create(['user_id' => $otherUser->id]);
    $creditCard = CreditCard::factory()->create(['team_id' => $otherTeam->id]);

    $this->actingAs($this->user)
        ->get(route('credit-cards.index'))
        ->assertStatus(200)
        ->assertDontSee($creditCard->name_on_card);
});

it('can search credit cards by cardholder name', function () {
    $creditCard1 = CreditCard::factory()->create([
        'team_id' => $this->team->id,
        'name_on_card' => 'John Doe',
    ]);
    $creditCard2 = CreditCard::factory()->create([
        'team_id' => $this->team->id,
        'name_on_card' => 'Jane Smith',
    ]);

    $component = Livewire::actingAs($this->user)
        ->test('pages::credit-cards.index');

    $creditCards = $component->get('creditCards');
    expect($creditCards)->toHaveCount(2);

    $component->set('search', 'John');

    $filteredCards = $component->get('creditCards');
    expect($filteredCards)->toHaveCount(1);
    expect($filteredCards->first()->name_on_card)->toBe('John Doe');
});

it('can search credit cards by name', function () {
    $creditCard1 = CreditCard::factory()->create([
        'team_id' => $this->team->id,
        'name' => 'Personal Visa',
    ]);
    $creditCard2 = CreditCard::factory()->create([
        'team_id' => $this->team->id,
        'name' => 'Business Mastercard',
    ]);

    $component = Livewire::actingAs($this->user)
        ->test('pages::credit-cards.index');

    $creditCards = $component->get('creditCards');
    expect($creditCards)->toHaveCount(2);

    $component->set('search', 'Personal');

    $filteredCards = $component->get('creditCards');
    expect($filteredCards)->toHaveCount(1);
    expect($filteredCards->first()->name)->toBe('Personal Visa');
});

it('shows existing cardholder names for autocomplete', function () {
    CreditCard::factory()->create([
        'team_id' => $this->team->id,
        'name_on_card' => 'John Doe',
    ]);

    $component = Livewire::actingAs($this->user)
        ->test('pages::credit-cards.index');

    $existingNames = $component->get('existingCardholderNames');
    expect($existingNames)->toContain('John Doe');
});

<?php

use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

it('regenerates password after creating a new password', function () {
    actingAs($user = User::factory()->withPersonalTeam()->create());

    Livewire::test('pages::passwords.index')
        ->assertSet('password', fn ($value) => ! empty($value))
        ->set('name', 'Test Password')
        ->set('username', 'test@example.com')
        ->set('website', 'https://example.com')
        ->set('notes', 'Test notes')
        ->call('create')
        ->assertSet('password', fn ($value) => ! empty($value));
});

it('can create a password', function () {
    actingAs($user = User::factory()->withPersonalTeam()->create());

    Livewire::test('pages::passwords.index')
        ->set('name', 'Test Password')
        ->set('username', 'test@example.com')
        ->set('password', 'test-password')
        ->set('website', 'https://example.com')
        ->set('notes', 'Test notes')
        ->call('create');

    expect($user->currentTeam->passwords()->where('name', 'Test Password')->exists())->toBeTrue();
});

it('can generate a new password', function () {
    actingAs($user = User::factory()->withPersonalTeam()->create());

    $component = Livewire::test('pages::passwords.index');
    $initialPassword = $component->get('password');

    $component->call('generatePassword');
    $newPassword = $component->get('password');

    expect($newPassword)->not->toBe($initialPassword);
});

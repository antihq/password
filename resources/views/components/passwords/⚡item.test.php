<?php

use App\Models\Password;
use App\Models\Team;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

it('renders password item', function () {
    $user = User::factory()->withPersonalTeam()->create();
    $password = Password::factory()->create(['team_id' => $user->currentTeam->id]);

    actingAs($user)
        ->get(route('passwords.index'))
        ->assertSee($password->name)
        ->assertSee($password->username);
});

it('can delete password from item component', function () {
    $user = User::factory()->withPersonalTeam()->create();
    $password = Password::factory()->create(['team_id' => $user->currentTeam->id]);

    Livewire::actingAs($user)
        ->test('pages::passwords.index')
        ->call('delete', $password->id);

    expect(Password::find($password->id))->toBeNull();
});

<?php

use App\Models\Password;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertModelExists;
use function Pest\Laravel\assertModelMissing;

it('displays the delete confirmation modal for a password', function () {
    $user = User::factory()->withPersonalTeam()->create();
    $password = Password::factory()->for($user->currentTeam)->create();

    actingAs($user)
        ->get('/passwords')
        ->assertOk()
        ->assertSee($password->name);
});

it('deletes a password when confirmed', function () {
    $user = User::factory()->withPersonalTeam()->create();
    $password = Password::factory()->for($user->currentTeam)->create();

    actingAs($user);

    Livewire::test('pages::passwords.index')
        ->call('delete', $password->id);

    assertModelMissing($password);
});

it('prevents deleting passwords from other teams', function () {
    $user = User::factory()->withPersonalTeam()->create();
    $otherUser = User::factory()->withPersonalTeam()->create();
    $password = Password::factory()->for($otherUser->currentTeam)->create();

    actingAs($user);

    Livewire::test('pages::passwords.index')
        ->call('delete', $password->id);

    assertModelExists($password);
})->throws(ModelNotFoundException::class);

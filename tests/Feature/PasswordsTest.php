<?php

use App\Models\Password;
use App\Models\Team;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->team = Team::factory()->create(['user_id' => $this->user->id]);
    $this->user->update(['current_team_id' => $this->team->id]);
});

it('can view passwords list', function () {
    $password = Password::factory()->create(['team_id' => $this->team->id]);

    $this->actingAs($this->user)
        ->get(route('passwords.index'))
        ->assertStatus(200)
        ->assertSee($password->name)
        ->assertSee($password->username);
});

it('cannot view passwords from other teams', function () {
    $otherUser = User::factory()->create();
    $otherTeam = Team::factory()->create(['user_id' => $otherUser->id]);
    $password = Password::factory()->create(['team_id' => $otherTeam->id]);

    $this->actingAs($this->user)
        ->get(route('passwords.index'))
        ->assertDontSee($password->name);
});

it('can create a password', function () {
    Livewire::actingAs($this->user)
        ->test('pages::passwords.create')
        ->set('name', 'Netflix')
        ->set('username', 'test@example.com')
        ->set('password', 'secret123')
        ->call('create')
        ->assertRedirect(route('passwords.index'));

    $this->assertDatabaseHas('passwords', [
        'name' => 'Netflix',
        'username' => 'test@example.com',
        'team_id' => $this->team->id,
    ]);
});

it('validates required fields when creating password', function () {
    Livewire::actingAs($this->user)
        ->test('pages::passwords.create')
        ->set('name', '')
        ->set('username', '')
        ->set('password', '')
        ->call('create')
        ->assertHasErrors(['name', 'username', 'password']);
});

it('can edit a password', function () {
    $password = Password::factory()->create(['team_id' => $this->team->id]);

    Livewire::actingAs($this->user)
        ->test('pages::passwords.edit', ['password' => $password])
        ->set('name', 'Updated Name')
        ->set('username', 'updated@example.com')
        ->set('passwordInput', 'newpassword123')
        ->call('update')
        ->assertRedirect(route('passwords.index'));

    $this->assertDatabaseHas('passwords', [
        'id' => $password->id,
        'name' => 'Updated Name',
        'username' => 'updated@example.com',
    ]);
});

it('cannot edit password from other team', function () {
    $otherUser = User::factory()->create();
    $otherTeam = Team::factory()->create(['user_id' => $otherUser->id]);
    $password = Password::factory()->create(['team_id' => $otherTeam->id]);

    $this->actingAs($this->user)
        ->get(route('passwords.edit', $password))
        ->assertForbidden();
});

it('validates required fields when updating password', function () {
    $password = Password::factory()->create(['team_id' => $this->team->id]);

    Livewire::actingAs($this->user)
        ->test('pages::passwords.edit', ['password' => $password])
        ->set('name', '')
        ->set('username', '')
        ->set('passwordInput', '')
        ->call('update')
        ->assertHasErrors(['name', 'username', 'passwordInput']);
});

it('can delete a password', function () {
    $password = Password::factory()->create(['team_id' => $this->team->id]);

    Livewire::actingAs($this->user)
        ->test('pages::passwords.index')
        ->call('delete', $password->id)
        ->assertNoRedirect();

    $this->assertDatabaseMissing('passwords', [
        'id' => $password->id,
    ]);
});

it('cannot delete password from other team', function () {
    $otherUser = User::factory()->create();
    $otherTeam = Team::factory()->create(['user_id' => $otherUser->id]);
    $password = Password::factory()->create(['team_id' => $otherTeam->id]);

    $this->actingAs($this->user)
        ->get(route('passwords.edit', $password))
        ->assertForbidden();
});

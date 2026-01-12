<?php

use App\Models\Password;
use App\Models\Team;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->user = User::factory()->withPersonalTeam()->create();
});

it('mounts with pre-populated form values', function () {
    $password = Password::factory()->create(['team_id' => $this->user->currentTeam->id]);

    $component = Livewire::actingAs($this->user)
        ->test('passwords.item', ['password' => $password]);

    $component->assertSet('name', $password->name)
        ->assertSet('username', $password->username)
        ->assertSet('newPassword', $password->password);
});

it('can cancel edit mode', function () {
    $password = Password::factory()->create(['team_id' => $this->user->currentTeam->id]);

    $component = Livewire::actingAs($this->user)
        ->test('passwords.item', ['password' => $password]);

    $component->set('name', 'Modified Name')
        ->set('username', 'modified@example.com')
        ->set('newPassword', 'modifiedpassword');

    $component->call('cancelEdit');

    $component->assertSet('name', $password->name)
        ->assertSet('username', $password->username)
        ->assertSet('newPassword', $password->password);
});

it('can update password from modal', function () {
    $password = Password::factory()->create(['team_id' => $this->user->currentTeam->id]);

    Livewire::actingAs($this->user)
        ->test('passwords.item', ['password' => $password])
        ->set('name', 'Updated Name')
        ->set('username', 'updated@example.com')
        ->set('newPassword', 'newpassword123')
        ->call('save');

    $this->assertDatabaseHas('passwords', [
        'id' => $password->id,
        'name' => 'Updated Name',
        'username' => 'updated@example.com',
    ]);

    $password->refresh();
    expect($password->password)->toBe('newpassword123');
});

it('validates required fields when updating password', function () {
    $password = Password::factory()->create(['team_id' => $this->user->currentTeam->id]);

    Livewire::actingAs($this->user)
        ->test('passwords.item', ['password' => $password])
        ->set('name', '')
        ->set('username', '')
        ->set('newPassword', '')
        ->call('save')
        ->assertHasErrors(['name', 'username', 'newPassword']);
});

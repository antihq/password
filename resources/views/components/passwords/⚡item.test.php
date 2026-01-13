<?php

use App\Models\Password;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    $this->user = User::factory()->withPersonalTeam()->create();
});

it('mounts with pre-populated form values', function () {
    $password = Password::factory()->create(['team_id' => $this->user->currentTeam->id]);

    $component = Livewire::actingAs($this->user)
        ->test('passwords.item', ['password' => $password]);

    $component->assertSet('name', $password->name)
        ->assertSet('username', $password->username)
        ->assertSet('newPassword', $password->password)
        ->assertSet('website', $password->website);
});

it('can cancel edit mode', function () {
    $password = Password::factory()->create(['team_id' => $this->user->currentTeam->id]);

    $component = Livewire::actingAs($this->user)
        ->test('passwords.item', ['password' => $password]);

    $component->set('name', 'Modified Name')
        ->set('username', 'modified@example.com')
        ->set('newPassword', 'modifiedpassword')
        ->set('website', 'https://modified.com');

    $component->call('cancelEdit');

    $component->assertSet('name', $password->name)
        ->assertSet('username', $password->username)
        ->assertSet('newPassword', $password->password)
        ->assertSet('website', $password->website);
});

it('can update password from modal', function () {
    $password = Password::factory()->create(['team_id' => $this->user->currentTeam->id]);

    Livewire::actingAs($this->user)
        ->test('passwords.item', ['password' => $password])
        ->set('name', 'Updated Name')
        ->set('username', 'updated@example.com')
        ->set('newPassword', 'newpassword123')
        ->set('website', 'https://updated.com')
        ->call('save');

    $this->assertDatabaseHas('passwords', [
        'id' => $password->id,
        'name' => 'Updated Name',
        'username' => 'updated@example.com',
        'website' => 'https://updated.com',
    ]);

    $password->refresh();
    expect($password->password)->toBe('newpassword123');
});

it('validates required fields when updating password', function () {
    $password = Password::factory()->create(['team_id' => $this->user->currentTeam->id]);

    $component = Livewire::actingAs($this->user)
        ->test('passwords.item', ['password' => $password]);

    $component->set('name', '')
        ->set('username', '')
        ->set('newPassword', '')
        ->set('website', 'invalid-url')
        ->call('save')
        ->assertHasErrors(['name', 'username', 'newPassword', 'website']);
});

it('can save password without website', function () {
    $password = Password::factory()->create(['team_id' => $this->user->currentTeam->id, 'website' => null]);

    Livewire::actingAs($this->user)
        ->test('passwords.item', ['password' => $password])
        ->set('name', 'Updated Name')
        ->set('username', 'updated@example.com')
        ->set('newPassword', 'newpassword123')
        ->set('website', '')
        ->call('save');

    $this->assertDatabaseHas('passwords', [
        'id' => $password->id,
        'name' => 'Updated Name',
        'username' => 'updated@example.com',
        'website' => null,
    ]);
});

it('validates website url format', function () {
    $password = Password::factory()->create(['team_id' => $this->user->currentTeam->id]);

    $component = Livewire::actingAs($this->user)
        ->test('passwords.item', ['password' => $password]);

    $component->set('name', 'Test Name')
        ->set('username', 'test@example.com')
        ->set('newPassword', 'password123')
        ->set('website', 'not-a-valid-url')
        ->call('save')
        ->assertHasErrors(['website']);

    $component->set('website', 'https://valid-url.com')
        ->call('save')
        ->assertHasNoErrors(['website']);
});

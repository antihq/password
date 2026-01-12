<?php

use App\Models\Password;

it('returns null when website is null', function () {
    $password = Password::factory()->create(['website' => null]);

    expect($password->avatar_url)->toBeNull();
});

it('returns unavatar url when website exists', function () {
    $password = Password::factory()->create(['website' => 'https://github.com']);

    expect($password->avatar_url)->toBe('https://unavatar.io/github.com');
});

it('extracts domain from website url', function () {
    $password = Password::factory()->create(['website' => 'https://stripe.com/login']);

    expect($password->avatar_url)->toBe('https://unavatar.io/stripe.com');
});

it('handles subdomains correctly', function () {
    $password = Password::factory()->create(['website' => 'https://api.openai.com/v1']);

    expect($password->avatar_url)->toBe('https://unavatar.io/api.openai.com');
});

it('handles http urls', function () {
    $password = Password::factory()->create(['website' => 'http://example.com']);

    expect($password->avatar_url)->toBe('https://unavatar.io/example.com');
});

it('returns null when parse_url fails', function () {
    $password = Password::factory()->create(['website' => 'not-a-valid-url']);

    expect($password->avatar_url)->toBeNull();
});

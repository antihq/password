<?php

use function Pest\Laravel\get;

it('redirects to welcome', function () {
    $response = get('/');

    $response->assertRedirect('/welcome');
});

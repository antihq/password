<?php

use function Pest\Laravel\get;

it('show welcome page', function () {
    $response = get('/');

    $response->assertOk();
});

<?php

use Illuminate\Testing\Fluent\AssertableJson;

it('is possible to get csrf-cookie', function () {
    $this->get(route('csrf-cookie'))
        ->assertOk()
        ->assertJson(fn(AssertableJson $json) => $json->has('csrf-token'));
});

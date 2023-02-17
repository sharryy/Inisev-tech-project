<?php

it('is possible to create a website', function () {
    $this->assertDatabaseCount('websites', 0);

    $data = $this->postJson(route('website.store'), [
        'name' => $name = 'Test Website',
        'url'  => $url = 'https://test-website.com',
    ])->assertStatus(200);

    expect($data)
        ->and($data['error'])->toBe('')
        ->and($data['response']['name'])->toBe($name)
        ->and($data['response']['url'])->toBe($url);

    $this->assertDatabaseCount('websites', 1);
    $this->assertDatabaseHas('websites', [
        'name' => $name,
        'url'  => $url,
    ]);
});

it('is not possible to create a website without a name', function () {
    $this->postJson(route('website.store'), [
        'url' => 'https://test-website.com',
    ])->assertStatus(422);
});

it('is not possible to create a website without a url', function () {
    $this->postJson(route('website.store'), [
        'name' => 'Test Website',
    ])->assertStatus(422);
});

it('is not possible to create a website with an invalid url', function () {
    $this->postJson(route('website.store'), [
        'name' => 'Test Website',
        'url'  => 'invalid-url',
    ])->assertStatus(422);
});


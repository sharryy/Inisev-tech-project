<?php

use App\Models\User;
use App\Models\Website;
use Illuminate\Testing\Fluent\AssertableJson;

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

it('is possible to subscribe to a website', function () {
    $website = Website::factory()->create();

    $this->assertDatabaseCount('subscriptions', 0);

    $user = User::factory()->create();
    $this->postJson(route('website.subscribe', $website), [
        'users_user_id' => $user->user_id,
    ])->assertStatus(200)
        ->assertJson(fn(AssertableJson $json) => $json
            ->has('response', fn($json) => $json
                ->where('website_id', $website->website_id)
                ->where('name', $website->name)
                ->where('url', $website->url)
                ->where('users.0.user_id', $user->user_id)
                ->where('users.0.name', $user->name)
                ->where('users.0.email', $user->email)
                ->etc()
            )->etc()
        );
});

it('not possible for user to subscribe to a website twice', function () {
    $website = Website::factory()->create();
    $user = User::factory()->create();

    $this->postJson(route('website.subscribe', $website), [
        'users_user_id' => $user->user_id,
    ])->assertStatus(200);

    $this->postJson(route('website.subscribe', $website), [
        'users_user_id' => $user->user_id,
    ])->assertStatus(422)
        ->assertJsonValidationErrors('users_user_id');
});



<?php

use App\Models\User;
use App\Models\Website;

it('possible for user to subscribe to website', function () {
    $user = User::factory()->create();
    $website = Website::factory()->create();

    $this->postJson(route('website.subscribe', $website), [
        "users_user_id" => $user->user_id,
    ])->assertStatus(200);

    $this->assertDatabaseHas('subscriptions', [
        'users_user_id'       => $user->user_id,
        'websites_website_id' => $website->website_id,
    ]);
});

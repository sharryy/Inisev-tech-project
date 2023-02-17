<?php

use App\Mail\PostCreated;
use App\Models\Post;
use App\Models\User;
use App\Models\Website;

it('sends email to all subscribers uniquely', function () {
    Mail::fake();

    $website = Website::factory()->create();

    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $website->subscribers()->createMany([
        ['users_user_id' => $user1->user_id],
        ['users_user_id' => $user2->user_id],
    ]);

    Post::factory()->create([
        'websites_website_id' => $website->website_id,
    ]);

    $this->artisan('send:email');

    Mail::assertQueued(PostCreated::class, 2);
});

it('send no emails if no notifications are present', function () {
    Mail::fake();

    $website = Website::factory()->create();

    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $website->subscribers()->createMany([
        ['users_user_id' => $user1->user_id],
        ['users_user_id' => $user2->user_id],
    ]);

    Post::withoutEvents(function () use ($website) {
        Post::factory()->create([
            'websites_website_id' => $website->website_id,
        ]);
    });

    $user1->unreadNotifications->each(function ($notification) {
        $notification->markAsRead();
    });

    $user2->unreadNotifications->each(function ($notification) {
        $notification->markAsRead();
    });

    $this->artisan('send:email');

    Mail::assertNothingQueued();
});

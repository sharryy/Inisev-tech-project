<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Website;
use App\Notifications\PostCreated;

it('should send email to all subscribers', function () {
    Notification::fake();

    $website = Website::factory()->create();

    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $website->subscribers()->createMany([
        ['users_user_id' => $user1->user_id],
        ['users_user_id' => $user2->user_id],
    ]);

    $post = Post::factory()->create([
        'websites_website_id' => $website->website_id,
    ]);

    Notification::assertSentTo($user1, PostCreated::class, function ($notification, $channels) use ($post) {
        return $notification->post->post_id === $post->post_id;
    });

    Notification::assertSentTo($user2, PostCreated::class, function ($notification, $channels) use ($post) {
        return $notification->post->post_id === $post->post_id;
    });
});

it('should not send email to unsubscribed users', function () {
    Notification::fake();

    $website = Website::factory()->create();

    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $website->subscribers()->createMany([
        ['users_user_id' => $user1->user_id],
    ]);

    $post = Post::factory()->create([
        'websites_website_id' => $website->website_id,
    ]);


    Notification::assertNotSentTo($user2, PostCreated::class);
    Notification::assertSentTo($user1, PostCreated::class);
});

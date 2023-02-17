<?php

use App\Models\Website;

it('can create a post', function () {
    $website = Website::factory()->create();

    $this->assertDatabaseCount('posts', 0);

    $data = $this->postJson(route('post.store'), [
        'title'               => $title = 'My first post',
        'slug'                => $slug = 'my-first-post',
        'content'             => $content = 'This is my first post',
        'websites_website_id' => $website->website_id,
    ])->assertStatus(200);

    expect($data)
        ->and($data['error'])->toBe("")
        ->and($data['response']['title'])->toBe($title)
        ->and($data['response']['slug'])->toBe($slug)
        ->and($data['response']['content'])->toBe($content)
        ->and($data['response']['website']['website_id'])->toBe($website->website_id);

    $this->assertDatabaseCount('posts', 1);
    $this->assertDatabaseHas('posts', [
        'title'               => $title,
        'slug'                => $slug,
        'content'             => $content,
        'websites_website_id' => $website->website_id,
    ]);
});

it('not possible to create post without title', function () {
    $this->postJson(route('post.store'), [
        'slug'                => 'my-first-post',
        'content'             => 'This is my first post',
        'websites_website_id' => Website::factory()->create()->website_id,
    ])->assertStatus(422);
});

it('not possible to create post without slug', function () {
    $this->postJson(route('post.store'), [
        'title'               => 'My first post',
        'content'             => 'This is my first post',
        'websites_website_id' => Website::factory()->create()->website_id,
    ])->assertStatus(422);
});

it('not possible to create post without content', function () {
    $this->postJson(route('post.store'), [
        'title'               => 'My first post',
        'slug'                => 'my-first-post',
        'websites_website_id' => Website::factory()->create()->website_id,
    ])->assertStatus(422);
});

it('not possible to create post without website', function () {
    $this->postJson(route('post.store'), [
        'title'   => 'My first post',
        'slug'    => 'my-first-post',
        'content' => 'This is my first post',
    ])->assertStatus(422);
});

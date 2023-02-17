<?php

namespace App\Observers;

use App\Models\Post;
use App\Notifications\PostCreated;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     *
     * @param Post $post
     * @return void
     */
    public function created(Post $post): void
    {
        $subscribers = $post->website->subscribers;

        /*
         * Send notification to all subscribers
         */
        $subscribers->each(function ($subscriber) use ($post) {
            $subscriber->user->notify(new PostCreated($subscriber->user, $post));
        });
    }
}

<?php

namespace App\Listeners;

use App\Events\PostCreated;
use Artisan;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmails
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param PostCreated $event
     * @return void
     */
    public function handle(PostCreated $event): void
    {
        Artisan::call('send:email');
    }
}

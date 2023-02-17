<?php

namespace App\Console\Commands;

use App\Mail\PostCreated;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Console\Command;

class SendEmailToSubscribers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email to all subscribers';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $this->info("Fetching all users...");
        $users = User::all();

        $this->info("Sending emails to all users...");
        $users->each(function ($user) {
            $user->unreadNotifications->each(function ($notification) use ($user) {
                \Mail::to($user->email)->queue(new PostCreated($notification->data));
                $notification->markAsRead();
            });
        });

        $this->info("Emails sent successfully!");
    }
}

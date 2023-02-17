<?php

namespace App\Console\Commands;

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

    }
}

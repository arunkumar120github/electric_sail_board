<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send {user?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a marketing email to a user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user =User::get(['id', 'name']);
        $this->table(['id', 'name'] ,$user);
        $this->info('mail send');
    }
}

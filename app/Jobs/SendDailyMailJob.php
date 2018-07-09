<?php

namespace App\Jobs;

use App\Models\User;
use App\Mail\MailDaily;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendDailyMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user_test = User::orderBy('id', 'desc')->firstOrFail();
        $users = User::orderBy('id', 'desc')->get();
        \Mail::to($users)->send(new MailDaily($user_test));
    }
}

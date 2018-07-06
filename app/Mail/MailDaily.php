<?php

namespace App\Mail;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailDaily extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user =$user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $today = date('Y-m-d');
        $daily_posts = Post::where('created_at',$today)
        ->where('status',2)
        ->take(5)
        ->get();
        
        if(count($daily_posts)==0){
            $daily_posts = Post::orderBy('created_at','desc')
                ->take(5)
                ->get();
        }

        return $this->view('backend.mail', compact('daily_posts'));
    }
}

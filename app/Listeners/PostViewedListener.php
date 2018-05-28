<?php

namespace App\Listeners;

use App\Events\PostViewed;
use Illuminate\Session\Store;

class PostViewedListener
{
    const POST_SESSION_DELAY = 300;

    private $session;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Handle the event.
     *
     * @param  PostViewed  $event
     * @return void
     */
    public function handle(PostViewed $event)
    {
        $post = $event->post;
        $viewed_post_key = 'viewed_post_' . $post->id;
        if (!$this->isViewed($post)) {
            $post->count_viewed += 1;
            $this->putViewedSession($post);
            // throw new Exception("Error Processing Request", 1);

        } else {
            $time = time();
            $viewed_post = $this->session->get($viewed_post_key);
            if ($viewed_post['time'] < ($time - self::POST_SESSION_DELAY)) {
                $post->count_viewed += 1;
                $this->putViewedSession($post);
            }
        }
    }

    protected function isViewed($post)
    {
        $viewed_post_key = 'viewed_post_' . $post->id;
        // $viewed_session = $this->session->get($viewed_post_key, []);

        return $this->session->has($viewed_post_key);
    }

    protected function putViewedSession($post)
    {
        $time = time();
        // $time_delay = 300;
        $viewed_post_key = 'viewed_post_' . $post->id;
        $viewed_post = [
            'id' => $post->id,
            'time' => $time,
        ];

        $this->session->put($viewed_post_key, $viewed_post);

    }
}

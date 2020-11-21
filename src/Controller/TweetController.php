<?php

namespace Tweeter\Controller;

use Tweeter\Http\Response;

class TweetController
{
    public function saveTweet(): Response
    {

        return new Response('', 302, [
            'Location' => '/'
        ]);
    }
}

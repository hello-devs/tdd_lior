<?php

namespace Tweeter\Controller;

use PDO;
use Tweeter\Http\Response;
use Tweeter\Model\TweetModel;

class TweetController
{
    protected TweetModel $tweetModel;

    public function __construct(TweetModel $tweetModel)
    {
        $this->tweetModel = $tweetModel;
    }


    public function saveTweet(): Response
    {

        $this->tweetModel->save($_POST['author'], $_POST['content']);

        return new Response('', 302, [
            'Location' => '/'
        ]);
    }
}

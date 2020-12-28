<?php

namespace Tweeter\Controller;

use PDO;
use Tweeter\Http\Response;
use Tweeter\Model\TweetModel;

class TweetController
{
    protected TweetModel $tweetModel;
    protected array $requiredFields = ['author', 'content'];

    public function __construct(TweetModel $tweetModel)
    {
        $this->tweetModel = $tweetModel;
    }


    public function saveTweet(): Response
    {
        if ($response = $this->validateFields()) {
            return $response;
        }

        $this->tweetModel->save($_POST['author'], $_POST['content']);

        return new Response('', 302, ['Location' => '/']);
    }

    public function validateFields(): ?Response
    {
        $invalidFields = [];

        foreach ($this->requiredFields as $field) {
            if (empty($_POST[$field])) {
                $invalidFields[] = $field;
            }
        }

        if (empty($invalidFields)) return null;

        if (count($invalidFields) === 1) {
            return new Response($invalidFields[0] . ' is missing', 400);
        }

        return new Response(
            sprintf("Fields %s are missing", implode(", ",$invalidFields)),
            400);
    }
}

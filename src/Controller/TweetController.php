<?php

namespace Tweeter\Controller;

use Tweeter\Http\Response;

class TweetController
{
    public function saveTweet(): Response
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=tdd_lior;charset=utf8', 'root', '', [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);

        $query = $pdo->prepare('INSERT INTO tweet SET content = :content, author = :author, created_at = NOW()');
        $query->execute([
            'author' => $_POST['author'],
            'content' => $_POST['content'],
        ]);

        return new Response('', 302, [
            'Location' => '/'
        ]);
    }
}

<?php


namespace Twitter\Model;


use DateTime;
use Jajo\JSONDB;

class JsonTweetModel
{

    /**
     * JsonTweetModel constructor.
     */
    public function __construct()
    {
    }

    public function save(string $author, string $content)
    {
        $jsonDb = new JSONDB(__DIR__.'/../../data');
        $now = new DateTime();
        $id = $now->format('Ymd') . uniqid();

        $jsonDb
            ->insert('tweets.json',[
                'id' => $id,
                'author' => $author,
                'content' => $content,
            ]);

        return $id;
    }
}
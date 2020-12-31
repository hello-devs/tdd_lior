<?php


namespace Twitter\Model;


use DateTime;
use Jajo\JSONDB;
use stdClass;

class JsonTweetModel implements TweetModelInterface
{
    /**
     * @var JSONDB
     */
    private JSONDB $jsonDb;

    /**
     * JsonTweetModel constructor.
     */
    public function __construct()
    {
        $this->jsonDb = new JSONDB(__DIR__.'/../../data');
    }

    public function save(string $author, string $content)
    {
        $now = new DateTime();
        $id = $now->format('Ymd') . uniqid();

        $this->jsonDb
            ->insert('tweets.json',[
                'id' => $id,
                'author' => $author,
                'content' => $content,
            ]);

        return $id;
    }

    public function findById($id): ?stdClass
    {
        $tweets = $this->jsonDb->select()
            ->from('tweets.json')
            ->where(['id' => $id])
            ->get();

        return (count($tweets) === 0) ? null : (object) $tweets[0];
    }

    public function findAll(): array
    {
        return $this->jsonDb->select()
            ->from('tweets.json')
            ->get();
    }

    public function delete($id): void
    {
        $this->jsonDb->delete()
            ->from('tweets.json')
            ->where(['id' => $id])
            ->trigger();
    }


}
<?php


namespace Model;


use Jajo\JSONDB;
use PHPUnit\Framework\TestCase;
use Twitter\Model\JsonTweetModel;

class JsonTweetModelTest extends TestCase
{
    /**
     * @var JSONDB
     */
    private JSONDB $jsonDb;

    protected function setUp(): void
    {
        $this->jsonDb= new JSONDB(__DIR__ . '/../../data');

        if (file_exists(__DIR__ . '/../../data/tweets.json')) {
            unlink(__DIR__ . '/../../data/tweets.json');
        }
    }


    /** @test */
    public function we_can_save_a_tweet()
    {
        $model = new JsonTweetModel();

        $model->save('Dan', 'bullshit content');

        $tweets = $this->jsonDb
            ->select()
            ->from('tweets.json')
            ->get();

        $this->assertCount(1, $tweets);
    }

    /** @test */
    public function we_can_find_a_tweet_by_id()
    {
        //we have: tweet in db
        $id = uniqid();
        $this->jsonDb->insert('tweets.json',[
            'id' => $id,
            'author' => 'Dan',
            'content' => 'bullshit content'
        ]);


    }

}
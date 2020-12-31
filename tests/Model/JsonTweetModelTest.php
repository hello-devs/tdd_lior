<?php


namespace Model;


use Jajo\JSONDB;
use PHPUnit\Framework\TestCase;
use stdClass;
use Twitter\Model\JsonTweetModel;

class JsonTweetModelTest extends TestCase
{
    /**
     * @var JSONDB
     */
    private JSONDB $jsonDb;
    /**
     * @var JsonTweetModel
     */
    private JsonTweetModel $model;

    protected function setUp(): void
    {
        $this->jsonDb = new JSONDB(__DIR__ . '/../../data');
        $this->model = new JsonTweetModel();

        if (file_exists(__DIR__ . '/../../data/tweets.json')) {
            unlink(__DIR__ . '/../../data/tweets.json');
        }
    }

    /** @test */
    public function we_can_save_a_tweet()
    {
        $this->model->save('Dan', 'bullshit content');

        $tweets = $this->jsonDb
            ->select()
            ->from('tweets.json')
            ->get();

        $this->assertCount(1, $tweets);
    }

    /** @test */
    public function we_can_find_a_tweet_by_id()
    {
        //we have: tweet in db with $id
        $id = $this->model->save('Dan', 'find bullshit tweet');

        //we search tweet with id: $id
        $tweet = $this->model->findById($id);

        //We expect content is ... and author is ... and id is...
        $this->assertNotNull($tweet);
        $this->assertEquals('Dan', $tweet->author);
        $this->assertEquals('find bullshit tweet', $tweet->content);
        $this->assertEquals($id, $tweet->id);
    }

    /** @test */
    public function we_cant_find_a_nonexistent_tweet()
    {
        //we dont have this tweet with this $id
        //we search tweet with $id
        $tweet = $this->model->findById(uniqid());

        //We expect $tweet is null
        $this->assertNull($tweet);
    }

    /** @test */
    public function we_can_find_all_tweets()
    {
        //we have: tweets in db with $id,$id2
        $count = mt_rand(3, 20);
        for ($i = 0; $i < $count; $i++) {
            $this->model->save("Author $i", "Bullshit Content $i");
        }

        //we search all tweet
        $tweets = $this->model->findAll();

        //we expect $tweets is array
        $this->assertIsArray($tweets);
        //we expect count($tweets) === $count
        $this->assertCount($count, $tweets);
        //we expect $tweet[i] is object
        $this->assertIsObject($tweets[0]);
        //we expect author and content match to inserted data
        for ($i = 0; $i < $count; $i++) {
            $this->assertEquals("Author $i", $tweets[$i]->author);
            $this->assertEquals("Bullshit Content $i", $tweets[$i]->content);
        }
    }

    /** @test */
    public function we_can_delete_a_tweet()
    {
        //we have a number of tweet $beforeCount
        $count = mt_rand(3, 20);
        for ($i = 0; $i < $count; $i++) {
            $this->model->save("Author $i", "Bullshit Content $i");
        }
        //we have: tweet in db with $id and other tweets
        $id = $this->model->save('Dan', 'find bullshit tweet');

        //we delete tweet with id: $id
        $this->model->delete($id);

        $tweet = $this->model->findById($id);

        //we expect $tweet === null
        $this->assertNull($tweet);
        //we expect $beforeDeleteCount === $afterDeleteCount + 1
        $this->assertCount($count, $this->model->findAll());

    }

}
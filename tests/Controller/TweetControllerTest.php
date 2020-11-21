<?php

use PHPUnit\Framework\TestCase;

class TweetControllerTest extends TestCase
{

    /** @test */
    public function userCanSaveTweet()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=tdd_lior;charset=utf8', 'root', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        //setup: we want a emty database
        $pdo->exec('DELETE FROM tweet');

        //Have Got POST Request to /tweet.php
        //Have Got parameters "content" and "author"
        $_POST['author'] = 'Dan';
        $_POST['content'] = 'My first Tweet';

        //Controller manage request
        $controller = new Tweeter\Controller\TweetController();
        $response = $controller->saveTweet();

        //We expect to be redirected to /
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertArrayHasKey('Location', $response->getHeaders(), "Response headers have'nt 'Location' key");
        $this->assertEquals('/', $response->getHeaders()['Location']);

        //We expect tweet to be saved in DB
        $result = $pdo->query('SELECT t.* FROM tweet as t');

        $this->assertEquals(1, $result->rowCount());
        //We expect tweet "author" et "content" match with given parameters

    }
}

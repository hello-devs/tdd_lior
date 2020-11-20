<?php
//require_once __DIR__.'/../vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use Tweeter\Controller\HelloController;

class IndexTest extends TestCase
{
    public function testHomePageSayHello()
    {
        //given
        $_GET['name'] = 'Dan';

        //when(action...)
        $controller = new HelloController();
        $response = $controller->hello();

        //then
        $this->assertEquals("Bonjour Dan", $response->getContent());
        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()['Content-Type'] ?? null;

        $this->assertEquals('text/html', $contentType);
    }
}

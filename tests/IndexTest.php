<?php
namespace Test;

use PHPUnit\Framework\TestCase;
use Tweeter\Controller\HelloController;

class IndexTest extends TestCase
{
    protected HelloController $helloController;

    protected function setUp(): void
    {
        $this->helloController = new HelloController;
        //given
        $_GET = [];
    }

    public function testHomePageSayHello()
    {
        //given
        $_GET['name'] = 'Dan';

        //when(action...)
        $response = $this->helloController->hello();

        //then
        $this->assertEquals("Bonjour Dan", $response->getContent());
        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()['Content-Type'] ?? null;

        $this->assertEquals('text/html', $contentType);
    }

    public function test_even_if_name_empty_in_get()
    {
        //No given name
        //When controller call
        $response = $this->helloController->hello();

        //then
        $this->assertEquals('Bonjour tout le monde', $response->getContent());
    }
}

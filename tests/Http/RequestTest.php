<?php

namespace Test\Http;

use PHPUnit\Framework\TestCase;
use Tweeter\Http\Request;

class RequestTest extends TestCase {
    
    /** @test */
    public function we_can_instantiate_a_request()
    {
        $request = new Request([
            'author' => 'Dan',
            'content' => 'bullshit content'
        ]);

        $this->assertInstanceOf(Request::class,$request);
        $this->assertEquals('Dan',$request->get('author'));
        $this->assertEquals('bullshit content',$request->get('content'));
        $this->assertNull($request->get('unsetKey'));
    }

}
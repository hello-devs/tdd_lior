<?php

namespace Tdd\Controller;

use Tdd\Http\Response;

class HelloController
{

    public function hello()
    {
        $name = $_GET['name'];

        return new Response("Bonjour $name");
    }
}

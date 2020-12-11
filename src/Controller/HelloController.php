<?php

namespace Tweeter\Controller;

use Tweeter\Http\Response;

class HelloController
{

    public function hello()
    {
        $name = $_GET['name'] ?? 'tout le monde';

        return new Response("Bonjour $name");
    }
}

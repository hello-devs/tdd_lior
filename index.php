<?php

use Tweeter\Controller\HelloController;

require_once __DIR__.'/vendor/autoload.php';

$controller = new HelloController;
$response = $controller->hello();
// $response->setHeaders(['Content-Type' => "text/html"]);
// $response->setStatusCode(200);
$response->send();

<?php

namespace App;

use App\Controllers\ControllerInterface;
use App\Response\ErrorResponse;

/**
 * Application entry point.
 */
class App
{
    /**
     * @var string
     */
    private $page;
    /**
     * @var Request
     */
    private $request;
    /**
     * Uruchamia apke.
     */

    public function run(): void{


        //$this->processRouting();

        $this->request = Request::initialize();
        $serviceContainer = ServiceContainer::getInstance();
        $router = $serviceContainer->getService('router');
try {
    $matchedRoute = $router->match($this->request);
    $response = $matchedRoute($this->request);

    foreach ($response->getHeaders() as $header) {
        header($header);
    }

    echo $response->getBody();
}
catch(\Exception $exception) {
    echo "strona nie znaleziona";
    new Response\Response('home');
}
        }


    }




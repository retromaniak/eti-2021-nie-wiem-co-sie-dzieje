<?php

namespace App;

use App\Controllers\ControllerInterface;

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
     * Uruchamia aplikację.
     */
    public function run(): void
    {
        //$this->processRouting();
        $this->request = Request::initialize();
        $serviceContainer = ServiceContainer::getInstance();
        $router = $serviceContainer->get('router');

        /** @var Router $router */
        $matchedRoute = $router->match($this->request);
        if ($matchedRoute instanceof ControllerInterface) {
            $response = $matchedRoute($this->request);
            foreach ($response->getHeaders() as $header) {
                header($header);
            }

            echo $response->getBody();

        } else {
            $layout = new Layout($this->request, $matchedRoute);
            $layout->render();
        }
    }
}
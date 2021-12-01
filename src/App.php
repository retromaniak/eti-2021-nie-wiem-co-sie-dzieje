<?php

namespace App;

use App\Exception\PageNotFoundException;
use App\Response\ErrorResponse;
use Exception;

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

        try {
            /** @var Router $router */
            $matchedRoute = $router->match($this->request);
            $response = $matchedRoute($this->request);
        } catch (PageNotFoundException $exception) {
            $response = new ErrorResponse($router, $exception, 404);
        } catch (Exception $exception) {
            $response = new ErrorResponse($router, $exception, 500);
        }

        foreach ($response->getHeaders() as $header) {
            header($header);
        }

        echo $response->getBody();

    }
}
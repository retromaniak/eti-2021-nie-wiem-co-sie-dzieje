<?php

namespace App;

class App
{
    /**
     * @var request
     */
    private $request;

    /**
     * @var string
     */
    private $page;

    /**
     * Uruchamia aplikację.
     */
    public function run(): void
    {
        //$this->processRouting();
        $request = Request::initialize();
        $router = new Router($this->getRoutes());
        $page = $router->match($request);

        $layout = new Layout($request, $page);
        $layout->render();
    }

    /**
     * @return string
     */
    public function getPage(): string
    {
        return $this->page;
    }

    /**
     * @return string[]
     */
    private function getRoutes(): array
    {
        return [
            'homepage' => [
                'path' => '/',
                'page' => 'home'
            ],
            'article' => [
                'path' => '/article/{id}',
                'page' => 'article'
            ],
            'body' => [
                'path' => '/body',
                'page' => 'body'
            ]
        ];
    }
}
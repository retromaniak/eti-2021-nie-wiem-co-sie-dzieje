<?php

namespace App;

class Router
{
    /**
     * @var array
     */
    private $routes;

    /**
     * @param array $routes
     */
    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function match(Request $request)
    {
        foreach ($this->routes as $route => $page) {
            if (preg_match("~^{$route}$~", $request->getPath(), $matches)) {
                for ($i = 1; $i < count($matches); ++$i) {
                    $request->addParam($matches[$i]);
                }

                return $page;
            }
        }

        throw new \Exception('Page not found! Sorry!');

    }
}
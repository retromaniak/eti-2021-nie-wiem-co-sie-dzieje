<?php

namespace App;

use App\Controllers\ControllerInterface;
use App\Exception\PageNotFoundException;

class Router
{
    /**
     * @var array
     */
    private $routes;

    /**
     * @param array $routes
     */
    public function __construct(array $routes = [])
    {
        $this->routes = $routes;
    }

    /**
     * @param string $name
     * @param array $routeConfig
     */
    public function addRoute(string $name, array $routeConfig)
    {
        $this->routes[$name] = $routeConfig;
    }

    /**
     * @param Request $request
     * @return string|ControllerInterface
     * @throws \Exception
     */
    public function match(Request $request)
    {
        $trimmedRequestPath = ltrim($request->getPath(), '/');
        $requestPathSegments = explode('/', $trimmedRequestPath);

        foreach ($this->routes as $routeName => $routeConfig) {
            $trimmedRoute = ltrim($routeConfig['path'], '/');
            $routeSegments = explode('/', $trimmedRoute);

            $params = $this->checkRoute($routeSegments, $requestPathSegments);
            if ($params !== false) {
                $request->setPathParameters($params);
                $controllerFactory = $routeConfig['controller'] ?? null;
                if ($controllerFactory instanceof \Closure) {
                    return $controllerFactory();
                } else {
                    if ($controllerFactory instanceof ControllerInterface) {
                        return $controllerFactory;
                    }
                }
                throw new PageNotFoundException();
            }
        }
        throw new PageNotFoundException();
    }

    /**
     * @param array $routeSegments
     * @param array $requestPathSegments
     * @return array|false
     */
    private function checkRoute(array $routeSegments, array $requestPathSegments)
    {
        $params = [];
        for ($i = 0; $i < count($routeSegments); $i++) {
            if (preg_match('/^{(.*)}$/', $routeSegments[$i], $matches)) {
                $params[$matches[1]] = $requestPathSegments[$i];
            } else {
                if ($routeSegments[$i] !== $requestPathSegments[$i]) {
                    return false;
                }
            }
        }
        return $params;
    }

    public function generate($name, $params = [])
    {
        if (!isset($this->routes[$name])) {
            throw new \Exception(sprintf('Route "%s" not found.', $name));
        }

        $path = $this->routes[$name]['path'];
        $trimmedRoute = ltrim($path, '/');
        $routeSegments = explode('/', $trimmedRoute);
        $uri = [];
        for ($i = 0; $i < count($routeSegments); $i++) {
            if (preg_match('/^{(.*)}$/', $routeSegments[$i], $m)) {
                $uri[] = $params[$m[1]] ?? '';
            } else {
                $uri[] = $routeSegments[$i];
            }
        }

        return '/' . implode('/', $uri);
    }
}
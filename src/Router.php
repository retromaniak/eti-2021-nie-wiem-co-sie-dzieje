<?php

namespace App;

use App\Controllers\ControllerInterface;
use App\Response\ErrorResponse;

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

        $trimmedRequestPath = ltrim($request->getPath(),'/');
        $requestPathSegments = explode('/', $trimmedRequestPath);

        foreach ($this->routes as $routeName => $routeConfig) {
            $trimmedRoute = ltrim($routeConfig['path'],'/');
            $routeSegments = explode('/', $trimmedRoute);

            $params = $this->checkRoute($routeSegments, $requestPathSegments);
            if ($params !== false) {
                $request->setPathParameters($params);
                $controllerFactory = $routeConfig['controller']?? null;
                if(is_callable($controllerFactory)){
                    return $controllerFactory();
                }
                else if ($controllerFactory instanceof ControllerInterface){
                 return $controllerFactory;
                }

                throw new \Exception('Page not found! Sorry!');
            }
        }
        throw new \Exception('Page not found! Sorry!');


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

    public function generateUrl($name, $parameters = [])
    {
        if (!isset($this->routes[$name])) {
            throw new \Exception(sprintf('Route "%s" not found.', $name));
        }
        foreach ($this->routes as $key => $value) {
            if ($key === $name){
                $url = $value['path'];
                if (isset($parameters)) {
                    $url = str_replace('{id}', $parameters['id'], $value['path']);
                }
            }
        }
        return $url;
    }
}
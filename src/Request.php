<?php

namespace App;

class Request
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var array
     */
    private $queryParameters;

    /**
     * @var array
     */
    private $pathParamaters = [];

    /**
     * @param string $path
     * @param array $queryParameters
     */
    private function __construct(string $path, array $queryParameters)
    {
        $this->path = $path;
        $this->queryParameters = $queryParameters;
    }

    /**
     * @return Request
     */
    public static function initialize()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $index = strpos($uri, '?');

        if ($index === false) {
            $path = $uri;
        } else {
            $path = substr($uri, 0, $index);
        }

        return new self($path, $_GET);
    }

    /**
     * @return array
     */
    public function getQueryParameters(): array
    {
        return $this->queryParameters;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasQueryParam(string $name)
    {
        return isset($this->queryParameters[$name]);
    }

    /**
     * @param string $name
     * @param null $default
     * @return string
     */
    public function getQueryParam(string $name, $default = null): string
    {
        return $this->queryParameters[$name] ?? $default;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    /**
     * @param array $queryParameters
     */
    public function setQueryParameters(array $queryParameters): void
    {
        $this->queryParameters = $queryParameters;
    }

    /**
     * @param $parameters
     */
    public function setPathParameters($parameters)
    {
        $this->pathParamaters = $parameters;
    }

    /**
     * @return array
     */
    public function getParameter($name, $default = null)
    {
        return $this->pathParamaters[$name] ?? $default;
    }

    /**
     * @return array
     */
    public function getPathParamaters()
    {
        return $this->pathParamaters;
    }
}
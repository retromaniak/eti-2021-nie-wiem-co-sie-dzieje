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
     * @var string
     */
    private string $method = 'GET';

    /**
     * @var array
     */
    private array $post = [];

    /**
     * @param string $path
     * @param string $method
     * @param array $queryParameters
     * @param array $post
     */
    private function __construct(
        string $path,
        string $method,
        array $queryParameters,
        array $post
    ) {
        $this->path = $path;
        $this->queryParameters = $queryParameters;
        $this->method = $method;
        $this->post = $post;
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

        return new self($path, $_SERVER['REQUEST_METHOD'], $_GET, $_POST);
    }

    /**
     * @return bool
     */
    public function isPost(): bool
    {
        return strtoupper($this->method) === 'POST';
    }

    /**
     * @param string $name
     * @param null $default
     * @return mixed|null
     */
    public function getPost(string $name, $default = null)
    {
        return $this->post[$name] ?? $default;
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
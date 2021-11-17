<?php

namespace App\Response;

class Response
{
    /**
     * @var array
     */
    private $headers;

    /**
     * @var string
     */
    private $body;

    /**
     * @var int
     */
    private $status;

    /**
     * @param $body
     * @param array $headers
     * @param int $status
     */
    public function __construct($body, array $headers = [], int $status = 200)
    {
        $this->body = $body;
        $this->headers = $headers;
        $this->status = $status;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        $genericHeaders = [
            sprintf('HTTP/1.1 %s', $this->status),
            sprintf('Content-Length: %d', strlen($this->body))
        ];

        return array_merge($genericHeaders, $this->headers);
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }
}
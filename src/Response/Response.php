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
    public function __construct($body,$headers = [],$status = 200)
    {
       $this->body = $body;
       $this->headers = $headers;
       $this->status = $status;
    }

    public  function  getHeaders()
    {
        $genericHeaders = [
            sprintf('HTTP/1.1 %s',$this->status),
            sprintf('Content-Length: %s',strlen($this->body))
        ];
        return array_merge($genericHeaders,$this->headers);
    }
    public  function getBody():string
    {
        return $this->body ;
    }
}
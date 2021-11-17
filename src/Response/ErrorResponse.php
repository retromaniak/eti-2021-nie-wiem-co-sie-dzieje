<?php

namespace App\Response;

class ErrorResponse extends Response
{
    public function __construct($body, $headers = [], $status = 404)
    {
        $additionalHeaders = ['Content-Type: application/json'];
        parent::__construct(
            $body,
            array_merge($additionalHeaders, $headers),
            $status);
        return "page not found";
    }

}
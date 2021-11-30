<?php

namespace App\Response;

class JsonResponse extends Response
{
    public function __construct(
        $body,
        array $headers = [],
        int $status = 200
    ) {
        $additionalHeaders = ['Content-Type: application/json'];
        parent::__construct(
            json_encode($body),
            array_merge($additionalHeaders, $headers),
            $status);
    }
}
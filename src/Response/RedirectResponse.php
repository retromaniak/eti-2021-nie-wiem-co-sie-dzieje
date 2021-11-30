<?php

namespace App\Response;

class RedirectResponse extends Response
{
    public function __construct(string $url, bool $permanent = false)
    {
        parent::__construct(sprintf('Redirecting to: %s', $url), [
            sprintf('Location: %s', $url)
        ], $permanent ? 301 : 302);
    }
}
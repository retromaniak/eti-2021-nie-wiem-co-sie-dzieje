<?php

namespace App\Response;

use App\Router;

class ErrorResponse extends LayoutResponse
{
    public function __construct(Router $router, $exception, $errorCode)
    {
        parent::__construct(
            sprintf('errors/%d', $errorCode),
            [
                'router' => $router,
                'exception' => $exception
            ], 'default', [], $errorCode
        );
    }
}
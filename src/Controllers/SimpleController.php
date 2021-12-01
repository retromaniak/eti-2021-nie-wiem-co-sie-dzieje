<?php

namespace App\Controllers;

use App\Request;
use App\Response\JsonResponse;
use App\Response\Response;

class SimpleController implements ControllerInterface
{
    /**
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $body = [
            'Some test value',
            'param1' => 'value 1'
        ];

        return new JsonResponse($body);
    }
}
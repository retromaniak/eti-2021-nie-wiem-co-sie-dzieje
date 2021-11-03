<?php
namespace App\Controllers;
use App\Request;
use App\Responce;
class SimpleController implements ControllerInterface
{
    /**
     * @param Request $request
     * @return Responce
     */
    public function __invoke(Request $request): Responce
    {
        $body = [
            'Some test value',
            'param1' => 'value1'
        ];
        $additionalHeaders = ['Content-Type: application/json'];
        return new Responce(json_encode($body), $additionalHeaders);
    }
}
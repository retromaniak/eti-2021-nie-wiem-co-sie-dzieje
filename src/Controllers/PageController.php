<?php

namespace App\Controllers;

use App\Layout;
use App\Request;
use App\Response\Response;

class PageController implements ControllerInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $layout;

    public function __construct(string $name,string $layout)
    {
        $this->name =$name;
        $this->layout=$layout;
    }
    public function  __invoke(Request $request): Response
    {
        $body = new Layout($request,$this->name,$this->layout);
        return new Response($body->render());
    }
}
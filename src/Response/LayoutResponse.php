<?php

namespace App\Response;

use App\Layout;

class LayoutResponse extends Response
{
    public function __construct(string $name, array $params = [], string $layout = 'default', $headers = [], $status = 200)
    {
        $layout = new Layout($name, $layout,'APSL Website!', $params);
        parent::__construct($layout->render(), $headers, $status);
    }
}
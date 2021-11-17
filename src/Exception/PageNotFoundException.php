<?php

namespace App\Exception;

use Exception;

class PageNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Page not found. Sorry!');
    }
}
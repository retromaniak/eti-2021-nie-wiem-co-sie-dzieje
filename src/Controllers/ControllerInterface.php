<?php

namespace App\Controllers;
use App\Request;
use App\Responce;

interface ControllerInterface
{
    public function __invoke(Request $request): Responce;
}
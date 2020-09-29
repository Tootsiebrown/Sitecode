<?php

namespace App\Http\Controllers;

class ExceptionController extends \Controller
{
    public function exception()
    {
        throw new \Exception('an error');
    }
}

<?php

namespace App\Http\Controllers;

class WebHookController extends Controller
{
    public function orderShipped(Request $request)
    {
        \Log::info(print_r(request(), 1));
    }
}

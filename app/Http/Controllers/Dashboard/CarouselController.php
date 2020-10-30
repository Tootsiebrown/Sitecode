<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class CarouselController extends Controller
{
    public function index()
    {
        return view('dashboard.carousel.index');
    }
}

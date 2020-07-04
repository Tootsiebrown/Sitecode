<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

if (App::environment() == 'dev') {
    Route::get('/frontend-test', function(){
        return view('site.pages.test');
    });
}

Route::get('/site-information', function(){
    return view('site.pages.site-info');
});

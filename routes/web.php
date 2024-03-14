<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function ()
{
    return view('auth.login');
});

Route::post('/login', function ()
{
    return view('auth.login');
})->name('login');

Route::get('/login', function ()
{
    return view('auth.login');
})->name('home');

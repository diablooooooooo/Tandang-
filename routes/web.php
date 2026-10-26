<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::view('/login', 'login');
Route::view('/register', 'register');

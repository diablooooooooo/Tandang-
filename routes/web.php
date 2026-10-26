<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::view('/login', 'login')->name('login');
Route::view('/register', 'register');

Route::post('/web-login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required', 'string'],
    ]);

    if (! Auth::attempt($credentials)) {
        return response()->json([
            'message' => 'Email atau kata sandi salah.',
        ], 422);
    }

    $request->session()->regenerate();

    return response()->json([
        'message' => 'Login berhasil.',
        'redirect' => route('dashboard'),
    ]);
});

Route::middleware('auth')->get('/dashboard', function () {
    return view('dashboard', [
        'user' => Auth::user(),
    ]);
})->name('dashboard');

Route::post('/web-logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
})->middleware('auth')->name('logout');
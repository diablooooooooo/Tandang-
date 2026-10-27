<?php

use App\Http\Controllers\OrganizationProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::get('/login', function () {
    if (Auth::check()) {
        return Auth::user()->isPenyedia()
            ? redirect()->route('penyedia.profile')
            : redirect()->route('dashboard');
    }
    return view('login');
})->name('login');

Route::get('/register', function () {
    if (Auth::check()) {
        return Auth::user()->isPenyedia()
            ? redirect()->route('penyedia.profile')
            : redirect()->route('dashboard');
    }
    return view('register');
})->name('register');

Route::post('/web-login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required', 'string'],
    ]);

    if (! Auth::attempt($credentials, $request->boolean('remember'))) {
        return response()->json([
            'message' => 'Email atau kata sandi salah.',
        ], 422);
    }

    $request->session()->regenerate();

    $user = Auth::user();
    $redirect = $user->isPenyedia()
        ? route('penyedia.profile')
        : route('dashboard');

    return response()->json([
        'message' => 'Login berhasil.',
        'redirect' => $redirect,
    ]);
});

Route::middleware('auth')->get('/dashboard', function () {
    return view('dashboard', [
        'user' => Auth::user(),
    ]);
})->name('dashboard');

Route::middleware(['auth', 'penyedia'])->prefix('penyedia')->name('penyedia.')->group(function () {
    Route::get('/profil', [OrganizationProfileController::class, 'edit'])->name('profile');
    Route::post('/profil', [OrganizationProfileController::class, 'update'])->name('profile.update');
});

Route::post('/web-logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
})->middleware('auth')->name('logout');

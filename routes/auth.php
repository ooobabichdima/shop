<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

// Simple auth routes (для MVP без полного Breeze)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (\Illuminate\Http\Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials, $request->filled('remember'))) {
        $request->session()->regenerate();

        if (auth()->user()->isAdmin()) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->intended('/');
    }

    return back()->withErrors([
        'email' => 'Невірні дані для входу.',
    ])->onlyInput('email');
});

Route::post('/logout', function (\Illuminate\Http\Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->name('logout');

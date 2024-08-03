<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('cart/list', 'cart')->name('cart.list');

Route::get('{slug}', \App\Http\Controllers\SlugController::class);

// Auth
Route::get('actions/logout', function ()
{
	\Illuminate\Support\Facades\Auth::logout();

	session()->invalidate();
	session()->regenerateToken();

	return redirect()->route('home');
})->name('logout');

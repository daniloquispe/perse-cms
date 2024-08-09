<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::get('search/{search}', \App\Http\Controllers\SearchController::class)->name('search');
Route::view('cart/list', 'cart')->name('cart.list');

Route::get('profile', \App\Http\Controllers\ProfileController::class)->name('profile');

Route::get('{slug}', \App\Http\Controllers\SlugController::class);

// Auth
Route::get('actions/logout', function ()
{
	\Illuminate\Support\Facades\Auth::guard('storefront')->logout();

	session()->invalidate();
	session()->regenerateToken();

	return redirect()->route('home');
})->name('logout');

<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Http\Controllers\HomeController::class)->name('home');
Route::get('search/{search}', \App\Http\Controllers\SearchController::class)->name('search');

// Cart pages
Route::get('cart/list', \App\Livewire\Cart\CartPage::class)->name('cart.list');

Route::get('{slug}', \App\Http\Controllers\SlugController::class);

// Customer routes
Route::middleware('auth:storefront')->group(function ()
{
	Route::get('customer/profile', \App\Livewire\Customer\CustomerPage::class)->name('customer.profile');
	Route::get('customer/addresses', \App\Livewire\Customer\CustomerPage::class)->name('customer.addresses');
	Route::get('customer/orders', \App\Livewire\Customer\CustomerPage::class)->name('customer.orders');
	Route::get('customer/favorites', \App\Livewire\Customer\CustomerPage::class)->name('customer.favorites');
});

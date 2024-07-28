<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Site
Route::get('marquee', [\App\Http\Controllers\Api\SiteController::class, 'marquee']);
Route::get('main-menu', [\App\Http\Controllers\Api\SiteController::class, 'mainMenu']);
Route::get('social-links', [\App\Http\Controllers\Api\SiteController::class, 'socialLinks']);

// Home
Route::get('home/slider', [\App\Http\Controllers\Api\HomeController::class, 'slider']);

// Slugs: Books, book categories and information pages
Route::get('slug/{slug}', \App\Http\Controllers\Api\SlugController::class);

// Auth
Route::post('auth/register', \App\Http\Controllers\Api\Auth\RegisterCustomerController::class);

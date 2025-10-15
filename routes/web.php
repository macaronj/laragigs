<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Homepage - All listings
Route::get('/', [ListingController::class, 'index']);

// Manage listing
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

// Show create listing Form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// Store listing data
Route::post('/listings/', [ListingController::class, 'store'])->middleware('auth');

// Show single listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);

// Edit single listing
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

// Update listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

// Delete listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');


// Show register form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Create a user
Route::post('/users', [UserController::class, 'store'])->middleware('guest');

// Log a user out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Log a user in
Route::post('/users/authenticate', [UserController::class, 'authenticate'])->middleware('guest');

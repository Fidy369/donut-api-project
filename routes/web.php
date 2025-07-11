<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonutController;

// Route to fetch and store API data
Route::get('/fetch', [DonutController::class, 'fetchAndStore']);

// Route to display data (now served at root "/")
Route::get('/', [DonutController::class, 'index'])->name('donuts.index');

<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::resource('orders', App\Http\Controllers\OrderController::class);

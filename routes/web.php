<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
Route::resource('products', ProductController::class);

use App\Http\Controllers\AuthorController;
Route::resource('authors', AuthorController::class);

use App\Http\Controllers\BookController;
Route::resource('books', BookController::class);

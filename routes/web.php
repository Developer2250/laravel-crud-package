<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::resource('products', ProductController::class);

use App\Http\Controllers\AuthorController;

Route::resource('authors', AuthorController::class);


Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\UserController;
Route::resource('users', UserController::class);

use App\Http\Controllers\PostController;
Route::resource('posts', PostController::class);

use App\Http\Controllers\CommentController;
Route::resource('comments', CommentController::class);

use App\Http\Controllers\BookController;
Route::resource('books', BookController::class);

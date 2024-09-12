<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\PostsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix( 'admin' )->name( 'admin.' )->group( function() {
    Route::resource( 'categories', CategoriesController::class );
    Route::resource( 'posts', PostsController::class );
});

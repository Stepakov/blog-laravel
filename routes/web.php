<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::/*middleware( 'auth' )->*/prefix( 'admin' )->name( 'admin.' )->group( function() {
    Route::resource( 'categories', CategoriesController::class );
    Route::resource( 'posts', PostsController::class );
    Route::resource( 'tags', TagsController::class );

    Route::get( 'users/create', [ UsersController::class, 'register' ] )->name( 'users.register' );
    Route::get( 'users/login', [ UsersController::class, 'login' ] )->name( 'users.login' );
    Route::get( 'users', [ UsersController::class, 'index' ] )->name( 'users.index' );
    Route::post( 'users/register', [ UsersController::class, 'storeRegister' ] )->name( 'users.registerStore' );
    Route::post( 'users/login', [ UsersController::class, 'storeLogin' ] )->name( 'users.loginStore' );
    Route::post( 'users/logout', [ UsersController::class, 'logout' ] )->name( 'users.logout' );
});

Route::get('login', function () {

})->name( 'login' );

Route::get('/email/verify', function () {

    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {

    $request->fulfill();

    return redirect()->route( 'admin.users.index');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

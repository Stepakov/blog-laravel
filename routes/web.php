<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Http\Controllers\Admin\Auth\PasswordResetController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\Auth\VerificationEmailController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::/*middleware( 'auth' )->*/prefix( 'admin' )->name( 'admin.' )->group( function() {
    Route::resource( 'categories', CategoriesController::class );
    Route::resource( 'posts', PostsController::class );
    Route::resource( 'tags', TagsController::class );

    Route::get( 'users/create', [ RegisterController::class, 'register' ] )->name( 'users.register' );
    Route::post( 'users/register', [ RegisterController::class, 'storeRegister' ] )->name( 'users.registerStore' );
    Route::get( 'users/login', [ LoginController::class, 'login' ] )->name( 'users.login' );
    Route::post( 'users/login', [ LoginController::class, 'storeLogin' ] )->name( 'users.loginStore' );
    Route::post( 'users/logout', [ LogoutController::class, 'logout' ] )->name( 'users.logout' );
    Route::get( 'users', [ UsersController::class, 'index' ] )->name( 'users.index' );
    Route::get( 'profile/{user}', [ UsersController::class, 'profile' ] )->name( 'profile' );
    Route::post( 'profile', [ UsersController::class, 'profileUpdate' ] )->name( 'profile.update' );
});

Route::get('login', function () {

})->name( 'login' );

Route::get('/email/verify', [ VerificationEmailController::class, 'verificationNotice'])
    ->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [ VerificationEmailController::class, 'verificationVerify' ])
    ->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', [ VerificationEmailController::class, 'verificationSend' ])
    ->middleware(['auth', 'throttle:2,1'])->name('verification.send');

Route::get('/forgot-password', [ PasswordResetController::class, 'passwordRequest' ])
    /*->middleware('guest')*/->name('password.request');

Route::post('/forgot-password', [ PasswordResetController::class, 'passwordEmail' ])
    /*->middleware('guest')*/->name('password.email');

Route::get('/reset-password/{token}', [ PasswordResetController::class, 'passwordReset'])
    /*->middleware('guest')*/->name('password.reset');

Route::post('/reset-password', [ PasswordResetController::class, 'passwordUpdate'])
    /*->middleware('guest')*/->name('password.update');

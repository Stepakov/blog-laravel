<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Admin\UsersController;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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
    Route::get( 'profile/{user}', [ UsersController::class, 'profile' ] )->name( 'profile' );
    Route::post( 'profile', [ UsersController::class, 'profileUpdate' ] )->name( 'profile.update' );
});

Route::get('login', function () {

})->name( 'login' );

Route::get('/email/verify', [ UsersController::class, 'verificationNotice'])
    ->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [ UsersController::class, 'verificationVerify' ])
    ->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', [ UsersController::class, 'verificationSend' ])
    ->middleware(['auth', 'throttle:2,1'])->name('verification.send');

Route::get('/forgot-password', [ UsersController::class, 'passwordRequest' ])
    /*->middleware('guest')*/->name('password.request');

Route::post('/forgot-password', [ UsersController::class, 'passwordEmail' ])
    /*->middleware('guest')*/->name('password.email');

Route::get('/reset-password/{token}', [ UsersController::class, 'passwordReset'])
    /*->middleware('guest')*/->name('password.reset');

Route::post('/reset-password', [ UsersController::class, 'passwordUpdate'])
    /*->middleware('guest')*/->name('password.update');

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Mail\VerificationMail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::all();

        return view('admin.auth.index', compact('users'));
    }
    public function register()
    {
        return view( 'admin.auth.register');
    }

    public function storeRegister( StoreUserRequest $request )
    {
        $data = $request->validated();

        if( $request->hasFile('avatar') ) {
            $path = 'avatars/' . date( 'Y-m-d' );
            $data[ 'avatar' ] = Storage::disk( 'public')
                ->put( $path, $request->file('avatar') );
        }

        $user = User::create( $data );

        event(new Registered($user));

        Mail::to( $data[ 'email' ] )->send( new VerificationMail( $user ) );

        Auth::login( $user );

        return redirect()->route('verification.notice')
            ->with( 'success', trans( 'notifications.user.created' ) );
    }

    public function login()
    {
        return view( 'admin.auth.login');
    }

    public function storeLogin( LoginRequest $request )
    {
        $request->tryAuth();

        session()->regenerate();

        return redirect()->intended('/cars');
    }

    public function logout( Request $request )
    {
        Auth::guard( 'web' )->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->intended('/admin/users');
    }

    public function profile()
    {

    }
}

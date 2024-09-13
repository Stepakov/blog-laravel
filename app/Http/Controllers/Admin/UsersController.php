<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\ProfileUpdateRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Mail\VerificationMail;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

        return redirect()->intended('/admin/users');
    }

    public function logout( Request $request )
    {
        Auth::guard( 'web' )->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->intended('/admin/users');
    }

    public function profile( User $user )
    {
        return view( 'admin.auth.profile', compact('user') );
    }

    public function profileUpdate( ProfileUpdateRequest $request, User $user )
    {
        return view( 'admin.auth.profile', compact('user') );
    }

    public function verificationNotice()
    {
        return view('auth.verify-email');
    }

    public function verificationVerify( EmailVerificationRequest $request )
    {
        $request->fulfill();

        return redirect()->route( 'admin.users.index');
    }

    public function verificationSend( Request $request )
    {
            $request->user()->sendEmailVerificationNotification();

            return back()->with('message', 'Verification link sent!');
    }

    public function passwordRequest()
    {
        return view('auth.forgot-password');
    }

    public function passwordEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function passwordReset( string $token )
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

}

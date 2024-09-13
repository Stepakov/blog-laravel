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

    public function profile( User $user )
    {
        return view( 'admin.auth.profile', compact('user') );
    }

    public function profileUpdate( ProfileUpdateRequest $request, User $user )
    {
        return view( 'admin.auth.profile', compact('user') );
    }



    public function passwordRequest()
    {
        return view('auth.forgot-password');
    }



}

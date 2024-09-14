<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ProfileUpdateRequest;
use App\Models\User;

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

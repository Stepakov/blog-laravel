<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
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
}

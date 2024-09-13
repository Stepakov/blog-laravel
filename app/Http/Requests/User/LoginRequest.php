<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => [ 'required', 'string', 'email', 'max:255' ],
            'password' => [ 'required', 'string', 'min:3'],
            'remember_me' => [ 'string' ],
        ];
    }

    public function tryAuth()
    {
        if( !Auth::attempt(
            $this->only(['email', 'password']),
            $this->boolean('remember_me')

        )){
//        if( !Auth::attempt( $this->only(['email', 'password']), $this->boolean( 'remember' ) ) ){
            throw ValidationException::withMessages([
                'credentials' => trans('notifications.user.failed')
            ]);
        }
    }
}

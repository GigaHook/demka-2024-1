<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'login' => 'unique:App\Models\User,login',
            'tel' => 'unique:App\Models\User,tel',
            'email' => 'unique:App\Models\User,email',
        ], [
            'login.unique' => 'Этот логин уже занят',
            'tel.unique' => 'Этот телефон уже зарегистрирован',
            'email.unique' => 'Эта почта уже зарегистрирована',
        ]);

        auth()->login(User::create($request->all()));

        session()->regenerate();

        return to_route('orders.index');
    }

    public function login(Request $request): RedirectResponse
    {
        throw_unless(
            auth()->attempt($request->all()),
            ValidationException::withMessages([
                'login' => 'Неверный логин или пароль'
            ])
        );

        return to_route('orders.index');
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();

        return to_route('auth.loginpage');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin');
        }
        return view('auth');
    }

    public function login(Request $request)
    {
        $password = $request->input('password');
        if ($password === env('SITE_PASSWORD')) {
            $user = User::findOrFail(1);
            Auth::login($user);
            return redirect()->route('admin');
        }

        return redirect()->route('loginForm')->with('error', 'Неверный пароль');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('main');
    }
}

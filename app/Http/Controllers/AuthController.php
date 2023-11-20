<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return Redirect::route('dashboard');
        }

        return view('auth.login');
    }

    public function auth(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ],
            [
                'email.required' => 'O e-mail é obrigatório!',
                'password.min' => 'A senha deve ter no mínimo 6 caracteres!'
            ]);

        if (Auth::attempt($validatedData)) {
            $user = User::where('email', $validatedData['email'])->first();

            if ($user->status == 'inactive') {
                Auth::logout();
                $request->session()->regenerate();
                $request->session()->regenerateToken();
                return Redirect::route('login')->withErrors(['message' => 'Usuário desativado!']);
            }

            $request->session()->regenerate();

            return Redirect::route('dashboard');
        } else {
            return Redirect::route('login')->withErrors(['message' => 'E-mail ou senha incorretos!']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->regenerate();
        $request->session()->regenerateToken();
        return Redirect::route('login');
    }
}

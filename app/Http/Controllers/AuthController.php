<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('welcome');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $login = Str::lower($request->input('username'));
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $key = 'login-attempts:' . Str::lower($login) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);

            throw ValidationException::withMessages([
                'username' => "Terlalu banyak percobaan login. Coba lagi dalam {$seconds} detik."
            ]);
        }

        $user = \App\Models\User::where($fieldType, $login)->first();

        if ($user && Auth::attempt([$fieldType => $login, 'password' => $request->password])) {
            RateLimiter::clear($key);
            $request->session()->regenerate();

            return redirect()->route('dashboard')->with('success', 'Anda telah berhasil masuk');
        }

        RateLimiter::hit($key, 60);

        return back()->withErrors([
            'username' => 'Kredensial yang Anda masukkan salah.',
        ])->withInput($request->except('password'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return Auth::user()->isAdmin()
                ? redirect()->route('admin.dashboard')
                : redirect()->route('kepaladesa.dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'login.required' => 'Email atau Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $loginField = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $attempt = Auth::attempt([
            $loginField => $credentials['login'],
            'password' => $credentials['password'],
        ], $request->boolean('remember'));

        if ($attempt) {
            $request->session()->regenerate();
            $user = Auth::user();

            ActivityLog::record(
                'LOGIN',
                'Autentikasi',
                "Pengguna {$user->name} ({$user->role}) berhasil masuk ke sistem."
            );

            if ($user->isAdmin()) {
                return redirect()->intended(route('admin.dashboard'))->with('success', "Selamat datang kembali, {$user->name}!");
            }

            return redirect()->intended(route('kepaladesa.dashboard'))->with('success', "Selamat datang di Panel Monitoring, {$user->name}!");
        }

        return back()->withErrors([
            'login' => 'Email/Username atau password yang Anda masukkan tidak sesuai.',
        ])->onlyInput('login');
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            ActivityLog::record(
                'LOGOUT',
                'Autentikasi',
                "Pengguna {$user->name} ({$user->role}) telah keluar dari sistem."
            );
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('info', 'Anda telah berhasil logout.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function store(Request $request) {
        $credentials = $request->validate(['email' => ['required', 'email'],'password' => ['required']]);
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            if (Auth::user()->role === 'siswa') {
                return redirect()->route('siswa.dashboard');
            }
        }
        return back()->withErrors([
            'email' => 'Email atau password salah.' ,
        ])->onlyInput('email');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Petugas;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login.index'); 
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'user_login' => 'required|string',
        'pass_login' => 'required|string',
    ]);

    $user = Petugas::where('user_login', $credentials['user_login'])->first();

    if (!$user) {  // Periksa apakah user ditemukan
        return back()->withErrors([
            'user_login' => 'Username tidak ditemukan.', // Pesan error untuk username salah
        ])->withInput();
    }

    if (md5($request->pass_login) === $user->pass_login) {
        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->route('petugas.index');
    }
    

    return back()->withErrors([
        'pass_login' => 'Password salah.', // Pesan error untuk password salah
    ])->withInput();
}

public function logout(Request $request)
{
     Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/')->with('status', 'logout');
}
}
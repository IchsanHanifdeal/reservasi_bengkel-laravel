<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login', [
            'title' => 'Login',
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $userRole = Auth::user()->role;

            if ($userRole == 'admin') {
                $request->session()->regenerate();
                $user = Auth::user();
                $request->session()->put('id_user', $user->id_user);
                $request->session()->put('nama_depan', $user->nama_depan);
                $request->session()->put('nama_belakang', $user->nama_belakang);
                $request->session()->put('email', $user->email);
                $request->session()->put('username', $user->username);
                $request->session()->put('role', $user->role);
                return redirect()->intended('dashboard')->with('success', 'Login Sukses!');
            } elseif ($userRole == 'user') {
                $request->session()->regenerate();
                $user = Auth::user();
                $request->session()->put('id_user', $user->id_user);
                $request->session()->put('nama_depan', $user->nama_depan);
                $request->session()->put('nama_belakang', $user->nama_belakang);
                $request->session()->put('email', $user->email);
                $request->session()->put('username', $user->username);
                $request->session()->put('role', $user->role);
                return redirect()->intended('dashboard')->with('success', 'Login Sukses!');
            }

            return back()->with('loginError', 'Login failed, user role not recognized.');
        }

        toastr()->error('Email atau Password salah.');

        return back()->withErrors([
            'loginError' => 'Email atau Password salah.',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        toastr()->success('Logout Sukses, anda telah mengakhiri sesi');

        return redirect('/');
    }
}

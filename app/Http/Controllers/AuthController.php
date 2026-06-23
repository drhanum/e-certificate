<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);

        Auth::login($user);

        return redirect('/user/dashboard');
    }

    public function registerAdmin(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin'
        ]);

        Auth::login($user);

        return redirect('/admin/dashboard');
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'user'
        ];

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return redirect('/user/dashboard');
        }

        return back()->with('error', 'Akun user tidak ditemukan');
    }

    public function loginAdmin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            if ($user->role != 'admin') {
                Auth::logout();

                return back()->with('error', 'Akun ini bukan admin');
            }

            $request->session()->regenerate();

            return redirect('/admin/dashboard');
        }

        return back()->with('error', 'Email atau Password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
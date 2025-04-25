<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('auth.login');
    }

    public function loginSubmit(Request $request)
    {
        $data = $request->only('email', 'password');
        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect()->route('index');
        } else {
            return redirect()->route('login')->with('error', 'Email atau Password salah');
        }
    }

    public function registerView()
    {
        return view('auth.register');
    }

    public function registerSubmit(Request $request)
    {
        if (User::where('email', $request->email)->exists()) {
            return redirect()->route('register')->with(['errorEmail' => 'Email sudah dipakai']);
        }

        // Simpan user baru
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        // Auto login user setelah registrasi berhasil
        Auth::login($user);

        // Redirect ke halaman home setelah login
        return redirect()->route('login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->back();
    }
}

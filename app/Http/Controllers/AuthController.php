<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  // Menampilkan form login
  public function showLoginForm()
  {
    return view('auth.login');
  }

  // Menampilkan form register
  public function showRegisterForm()
  {
    return view('auth.register');
  }

  // Proses login
  public function login(Request $request)
  {
    // Validasi input
    $request->validate([
      'email' => 'required|email',
      'password' => 'required|min:6',
    ]);

    // Cek kredensial dan login
    if (Auth::attempt($request->only('email', 'password'))) {
      // Redirect ke halaman yang diinginkan setelah login
      if (Auth::user()->role === 'admin') {
        return redirect()->route('dashboard')->with('success', 'Anda berhasil login.');
      }
      return redirect()->route('home')->with('success', 'Anda berhasil login.');
    }

    // Jika login gagal
    return redirect()->back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
  }

  // Proses register
  public function register(Request $request)
  {
    // Validate input
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|min:6|confirmed',
    ]);

    // Create a new user
    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => bcrypt($request->password),
      'role' => 'user'
    ]);

    // Log in the user
    Auth::login($user);

    // Redirect to a desired page after registration
    return redirect()->route('home')->with('success', 'Registrasi berhasil, Anda telah login.');
  }

  // Logout
  public function logout()
  {
    Auth::logout();
    return redirect()->route('home')->with('success', 'Anda berhasil logout.');
  }

  // Check
  public function check()
  {
    if (auth()->check()) {
      // User is logged in, redirect to products.index
      return redirect()->route('home');
    } else {
      // User is not logged in, redirect to login
      return redirect()->route('login');
    }
  }
}

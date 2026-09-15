<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan Form Login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Memproses Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Jika yang login adalah Admin
            if (Auth::user()->hasRole('admin')) {
                return redirect()->intended(route('admin.dashboard'));
            }
            
            // Arahkan ke rute 'home' (/) agar fungsi index() yang menentukan tujuannya
            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'Email atau kata sandi yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // Menampilkan Form Register Pelamar
    public function showRegister()
    {
        return view('auth.register');
    }

    // Memproses Register Pelamar
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Pastikan role 'applicant' terbuat di database jika belum ada
        $rolePelamar = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'applicant']);
        
        // Pasangkan role tersebut ke user yang baru mendaftar
        $user->assignRole($rolePelamar);

        // Langsung login setelah daftar
        Auth::login($user);

        return redirect()->route('home');
    }

    /**
     * Mengatur rute default setelah login / pengecekan status akses publik
     */
    public function index()
    {
        // 1. Jika belum login (Tamu), tampilkan Landing Page
        if (!auth()->check()) {
            return view('landing');
        }

        // 2. Jika user adalah admin, lempar ke Dashboard Admin
        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        // 3. Jika pelamar (Role lainnya), langsung lempar ke Dashboard Pelamar
        // PERBAIKAN: Ubah 'dashboard' menjadi 'applicant.dashboard'
        return redirect()->route('applicant.dashboard');
    }

    // Memproses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
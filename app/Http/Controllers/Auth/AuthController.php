<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('username', mb_strtolower(trim($data['username'])))->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return back()->withErrors(['login' => 'Username atau kata sandi salah'])->withInput();
        }

        if ($user->status === 'pending') {
            return back()->withErrors(['login' => 'Akunmu masih menunggu persetujuan admin'])->withInput();
        }

        if ($user->status === 'rejected') {
            return back()->withErrors(['login' => 'Pendaftaranmu ditolak admin'])->withInput();
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route($user->isAdmin() ? 'dash' : 'home');
    }

    public function showRegister(): View
    {
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'dept' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'alpha_dash', 'unique:users,username'],
            'password' => ['required', 'string', 'min:4'],
        ], [
            'username.unique' => 'Username sudah dipakai',
            'username.alpha_dash' => 'Username tanpa spasi',
        ]);

        User::create([
            'name' => $data['nama'],
            'dept' => $data['dept'],
            'username' => mb_strtolower($data['username']),
            'password' => Hash::make($data['password']),
            'role' => 'user',
            'status' => 'pending',
        ]);

        return redirect()->route('login')
            ->with('toast', 'Pendaftaran terkirim. Tunggu persetujuan admin.')
            ->with('registered_username', mb_strtolower($data['username']));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

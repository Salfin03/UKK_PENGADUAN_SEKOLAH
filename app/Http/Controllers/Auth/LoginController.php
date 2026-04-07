<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function indexAdmin()
    {
        if (Auth::guard('admin')->check()) {
            return redirect('/admin/dashboard');
        }
        return view('auth.admin_login');
    }

    public function loginAdmin(Request $request)
    {
        $credentials = $request->validate([
            'Username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt(['Username' => $request->Username, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'Username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function indexSiswa()
    {
        if (Auth::guard('siswa')->check()) {
            return redirect('/siswa/dashboard');
        }
        return view('auth.siswa_login');
    }

    public function loginSiswa(Request $request)
    {
        $request->validate([
            'nis' => 'required'
        ]);

        $siswa = \App\Models\Siswa::find($request->nis);

        if ($siswa) {
            Auth::guard('siswa')->login($siswa);
            $request->session()->regenerate();
            return redirect()->intended('/siswa/dashboard');
        }

        return back()->withErrors([
            'nis' => 'NIS tidak ditemukan.',
        ]);
    }

    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('siswa')->check()) {
            Auth::guard('siswa')->logout();
        }
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

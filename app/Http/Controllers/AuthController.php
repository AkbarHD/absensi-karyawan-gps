<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function proseslogin(Request $request)
    {
        if (Auth::guard('karyawan')->attempt(['nik' => $request->nik, 'password' => $request->password])) {
            return redirect()->route('dashboard');
        } else {
            // jika gagal
            return redirect('/')->with(['warning' => 'Nik atau Password yang anda masukkan salah']);
        }
    }

    public function proseslogout()
    {
        if (Auth::guard('karyawan')->check()) {
            Auth::guard('karyawan')->logout();
        }
        return redirect('/');
    }

    public function prosesloginadmin(Request $request)
    {
        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // utk membedakan auth karyawan
            return redirect('/panel/dashboardadmin');
        } else {
            return redirect()->route('login.admin')->with(['warning' => 'Email atau Password salah']);
        }
    }

    public function proseslogoutadmin()
    {
        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
        }
        return redirect()->route('login.admin');
    }
}

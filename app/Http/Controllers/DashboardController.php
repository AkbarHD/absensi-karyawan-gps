<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $bulanini = date('m');
        $tahunini = date('Y');
        $hariini = date('Y-m-d');
        $absenHariini = DB::table('presensi')->where('nik', $nik)->where('tgl_presensi', $hariini)->first();
        $historibulanini = DB::table('presensi')->whereMonth('tgl_presensi', $bulanini)->whereYear('tgl_presensi', $tahunini)->orderBy('tgl_presensi', 'desc')->get();
        // $historibulanini = DB::table('presensi')
        //     ->whereRaw('MONTH(tgl_presensi)="' . $bulanini . '"')
        //     ->whereRaw('YEAR(tgl_presensi)="' . $tahunini . '"')
        //     ->orderBy('tgl_presensi', 'desc')->get();
        return view('dashboard.dashboard', compact('absenHariini', 'historibulanini'));
    }
}

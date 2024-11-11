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
        // jadi integer bukan string lagi
        $bulanini = date('m') * 1;
        // dd($bulanini);
        $tahunini = date('Y');
        $hariini = date('Y-m-d');
        // hanya menampilkan absen hari ini
        $absenHariini = DB::table('presensi')->where('nik', $nik)->where('tgl_presensi', $hariini)->first();
        // hanya menampilkan absen bulan ini
        $historibulanini = DB::table('presensi')->where('nik', $nik)->whereMonth('tgl_presensi', $bulanini)->whereYear('tgl_presensi', $tahunini)->orderBy('tgl_presensi', 'desc')->get();
        // $historibulanini = DB::table('presensi')
        //     ->whereRaw('MONTH(tgl_presensi)="' . $bulanini . '"')
        //     ->whereRaw('YEAR(tgl_presensi)="' . $tahunini . '"')
        //     ->orderBy('tgl_presensi', 'desc')->get();
        // menampilkan angka rekap presensi
        $rekappresensi = DB::table('presensi')
            // jumlah hadir, jumlah terlambat
            ->selectRaw('COUNT(nik) as jmlhadir, SUM(IF(jam_in > "07:00", 1, 0)) as jmlterlambat')
            ->where('nik', $nik)
            ->whereMonth('tgl_presensi', $bulanini)->whereYear('tgl_presensi', $tahunini)
            ->first();
        // dd($rekappresensi);
        $leaderboard = DB::table('presensi')->join('karyawan', 'presensi.nik', '=', 'karyawan.nik')
            ->select('karyawan.*', 'presensi.*')
            ->orderBy('jam_in')
            ->where('tgl_presensi', $hariini)->get();
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "Sepetember", "Oktober", "November", "Desember"];
        $rekapizin = DB::table('pengajuan_izin')->selectRaw('SUM(IF(status="i",1,0)) as jmlizin, SUM(IF(status="s",1,0)) as jmlsakit')
            ->where('nik', $nik)->where('status_approved', 1)
            ->whereMonth('tgl_izin', $bulanini)->whereYear('tgl_izin', $tahunini)->first();
        // dd($namabulan[$bulanini]);
        return view('dashboard.dashboard', compact('absenHariini', 'historibulanini', 'namabulan', 'tahunini', 'bulanini', 'rekappresensi', 'leaderboard', 'rekapizin'));

    }

    // for admin
    public function dashboardadmin()
    {
        return view('dashboard.dashboardadmin');
    }
}
